<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DevController extends AbstractController
{
    public function __construct(private ApiService $api) {

    }
    #[Route('/dev', name: 'app_dev')]
    public function index(): Response
    {
        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
        ]);
    }

    #[Route('/dev/adress', name: 'app_apia')]
    public function adress(Request $request): Response
    {

        return $this->render('form.html.twig', [
        ]);
    }
    #[Route('/dev/city', name: 'app_api222',)]
    public function city(Request $request): Response
    {
        

        $data = $request->request->all();

        $array = $this->api->getCity($data['city']);

          return $this->render('select.html.twig',[
            'option' => $array
            ]
        );
    }

    #[Route('/dev/map', name: 'app_api222tesrrrt',)]
    public function map(Request $request): Response
    {
            $data =   $request->request->all();

          return $this->render('map.html.twig',[
            'data' => $data
            ]
        );
    }
}
