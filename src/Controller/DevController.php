<?php

namespace App\Controller;

use App\Entity\Wizytowka;
use App\Service\ApiService;
use App\Service\PoiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dev', name: 'app_dev_')]

class DevController extends AbstractController
{ 
    public function __construct(private ApiService $api, private PoiService $poiService) {}
    public function index(): Response
    {
        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
        ]);
    }

    #[Route('/home', name: 'app_dev_home')]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/searchCity', name: 'searchCity', methods: ['POST'])]
    public function city(Request $request): Response
    {
        $data = $request->request->all();
        $hxRequest = $request->headers->get('HX-Request');

        if (isset($data['city']) && !empty($data['city'])) {
            $cities = $this->api->getCity($data['city']);
            return $this->render('/_partial/_select.html.twig', [
                'cities' => $cities,
                'hxRequest' => $hxRequest
            ]);
        }

        // Zwracamy pusty wynik, jeśli nie znaleziono miasta
        return new Response('<p>Brak wyników</p>', 200);
    }

    #[Route('/map', name: 'app_api222tesrrrt',)]
    public function map(Request $request): Response
    {
        $data = $request->request->all();
        $decodedData = json_decode($data['dataCity'], true);

        $north = $decodedData['info'][0]; // Północ
        $south = $decodedData['info'][1]; // Południe
        $east = $decodedData['info'][2]; // Wschód
        $west = $decodedData['info'][3]; // Zachód

        // Pobranie punktów na podstawie współrzędnych
        $punkty = $this->api->getPunkt($north, $east, $south, $west);

        // Przygotowanie identyfikatorów i danych początkowych
        $ids = [];
        $onlyIds = [];

        foreach ($punkty['elements'] as $element) {
            if (!empty($element['tags']['name'])) {
                $ids[$element['id']] = [$element['lat'], $element['lon'], $element['tags']['name']];
                $onlyIds[] = $element['id'];
            }
        }

        // Pobranie wizytówek
        $wizytkowki = $this->poiService->getWizytowka($onlyIds);
        $wizytowkaList = [];

        // Przekształcenie danych z wizytówki i dopasowanie do punktów
        foreach ($wizytkowki as $wizytkowka) {
            $id = $wizytkowka->getIdOpenstreetmap();
            if (isset($ids[$id])) {
                $wizytowkaList[] = new Wizytowka(
                    $wizytkowka->getLat(),
                    $wizytkowka->getLon(),
                    $id,
                    $wizytkowka->getNameRestaurant(),
                    $wizytkowka->getDescription(),
                    $wizytkowka->getImage(),
                    true
                );
                unset($ids[$id]);
            }
        }

        // Dodanie pozostałych punktów bez wizytówki
        foreach ($ids as $id => $point) {
            $wizytowkaList[] = new Wizytowka($point[0], $point[1], null, $point[2]);
        }

        // Renderowanie widoku z danymi
        return $this->render(
            'map.html.twig',
            [
                'lat' => $decodedData['lat'],
                'lon' => $decodedData['lon'],
                'wizytowka' => $wizytowkaList,
            ]
        );
    }

   
}
