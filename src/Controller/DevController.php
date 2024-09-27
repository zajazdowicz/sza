<?php

namespace App\Controller;

use App\Entity\Wizytowka;
use App\Service\ApiService;
use App\Service\PoiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DevController extends AbstractController
{
    public function __construct(private ApiService $api, private PoiService $poiService) {}
    #[Route('/dev', name: 'app_dev')]
    public function index(): Response
    {
        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
        ]);
    }

    #[Route('/dev/address', name: 'app_apia')]
    public function adress(Request $request): Response
    {

        return $this->render('form.html.twig', []);
    }
    #[Route('/dev/city', name: 'app_api222',)]
    public function city(Request $request): Response
    {


        $data = $request->request->all();

        $array = $this->api->getCity($data['city']);

        return $this->render(
            'select.html.twig',
            [
                'option' => $array
            ]
        );
    }

    #[Route('/dev/map', name: 'app_api222tesrrrt',)]
    public function map(Request $request): Response
    {
        $data =   $request->request->all();

        // $json = $data;
        $test = json_decode($data['dataCity'], true);

        $north = $test['info'][0]; // Północ
        $south = $test['info'][1]; // Południe
        $east = $test['info'][2]; // Wschód
        $west = $test['info'][3]; // Zachód

        $punkt =  $this->api->getPunkt($north, $east, $south, $west);
        $ids = [];
        $onlyIds = [];
        $wizytkowka = [];

        foreach ($punkt['elements'] as $value) {
            if (isset($value['tags']['name']) and $value['tags']['name'] != '') {
                $ids[$value['id']] = [$value['lat'], $value['lon'], $value['tags']['name']];
                $onlyIds[] = $value['id'];
            }
        }

        $wizytkowki = $this->poiService->getWizytowka($onlyIds);


        foreach ($wizytkowki as $value) {
            // $ids[] = $value['id'];

            if (array_key_exists($value->getIdOpenstreetmap(), $ids)) {

                $wizytkowka[] = new Wizytowka(
                    $value->getLat(),
                    $value->getLon(),
                    $value->getIdOpenstreetmap(),
                    $value->getNameRestaurant(),
                    $value->getDescription(),
                    $value->getImage(),
                    true
                );
                unset($ids[$value->getIdOpenstreetmap()]);
            }
        }
        foreach ($ids as $value) {
            $wizytkowka[] = new Wizytowka($value[0], $value[1], null, $value[2]);
        }

        return $this->render(
            'map.html.twig',
            [
                //'data' => $punkt,
                'lat' => $test['lat'],
                'lon' => $test['lon'],
                'wizytowka' => $wizytkowka
            ],
        );
    }
}
