<?php

namespace App\Controller;

use App\Entity\Wizytowka;
use App\Service\ApiService;
use App\Service\PoiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/dev')]

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

            // Jeżeli znajdziemy miasta, pobieramy współrzędne pierwszego
            $lat = $cities[0]['lat'] ?? null;
            $lon = $cities[0]['lon'] ?? null;

            return $this->render('/_partial/_select.html.twig', [
                'cities' => $cities,
                'lat' => $lat,
                'lon' => $lon,
                'hxRequest' => $hxRequest
            ]);
        }

        // Zwracamy pusty wynik, jeśli nie znaleziono miasta
        return new Response('<p>Brak wyników</p>', 200);
    }


    // #[Route('/searchResult', name: 'app_search_map', methods: ['POST'])]
    // public function search(Request $request): Response
    // {
    //     // Odbieramy współrzędne przekazane z formularza
    //     $lat = $request->request->get('lat');
    //     $lon = $request->request->get('lon');

    //     if (!$lat || !$lon) {
    //         // Obsługa przypadku, gdy współrzędne nie są dostępne
    //         return $this->render('map.html.twig', [
    //             'lat' => null,
    //             'lon' => null,
    //             'wizytowka' => [],
    //             'error' => 'Brak współrzędnych dla miasta.'
    //         ]);
    //     }

    //     // Pobierz POI na podstawie współrzędnych
    //     $punkty = $this->api->getPunkt($lat, $lon);

    //     // Pobierz wizytówki powiązane z punktami
    //     $wizytkowki = $this->poiService->getWizytowkaByCoordinates($lat, $lon);

    //     // Zwróć wyniki do widoku mapy
    //     return $this->render('map.html.twig', [
    //         'lat' => $lat,
    //         'lon' => $lon,
    //         'wizytowka' => $wizytkowki,
    //     ]);
    // }

    #[Route('/map/search', name: 'app_search_map', methods: ['POST'])]
    public function search(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $lat = $data['lat'];
        $lon = $data['lon'];

        // Fetch POI within a 10km radius using OpenStreetMap API
        $punkty = $this->api->getPunktWithinRadius($lat, $lon, 10000);

        // Check for matching business cards (wizytowka)
        $wizytkowki = $this->poiService->getWizytowkaByCoordinates($lat, $lon, 10000);

        return $this->json([
            'poi' => $punkty,
            'wizytowka' => $wizytkowki
        ]);
    }






    // #[Route('/map', name: 'app_api222tesrrrt',)]
    // public function map(Request $request): Response
    // {
    //     $data = $request->request->all();
    //     $decodedData = json_decode($data['dataCity'], true);

    //     $north = $decodedData['info'][0]; // Północ
    //     $south = $decodedData['info'][1]; // Południe
    //     $east = $decodedData['info'][2]; // Wschód
    //     $west = $decodedData['info'][3]; // Zachód

    //     // Pobranie punktów na podstawie współrzędnych
    //     $punkty = $this->api->getPunkt($north, $east, $south, $west);

    //     // Przygotowanie identyfikatorów i danych początkowych
    //     $ids = [];
    //     $onlyIds = [];

    //     foreach ($punkty['elements'] as $element) {
    //         if (!empty($element['tags']['name'])) {
    //             $ids[$element['id']] = [$element['lat'], $element['lon'], $element['tags']['name']];
    //             $onlyIds[] = $element['id'];
    //         }
    //     }

    //     // Pobranie wizytówek
    //     $wizytkowki = $this->poiService->getWizytowka($onlyIds);
    //     $wizytowkaList = [];

    //     // Przekształcenie danych z wizytówki i dopasowanie do punktów
    //     foreach ($wizytkowki as $wizytkowka) {
    //         $id = $wizytkowka->getIdOpenstreetmap();
    //         if (isset($ids[$id])) {
    //             $wizytowkaList[] = new Wizytowka(
    //                 $wizytkowka->getLat(),
    //                 $wizytkowka->getLon(),
    //                 $id,
    //                 $wizytkowka->getNameRestaurant(),
    //                 $wizytkowka->getDescription(),
    //                 $wizytkowka->getImage(),
    //                 true
    //             );
    //             unset($ids[$id]);
    //         }
    //     }

    //     // Dodanie pozostałych punktów bez wizytówki
    //     foreach ($ids as $id => $point) {
    //         $wizytowkaList[] = new Wizytowka($point[0], $point[1], null, $point[2]);
    //     }

    //     // Renderowanie widoku z danymi
    //     return $this->render(
    //         'map.html.twig',
    //         [
    //             'lat' => $decodedData['lat'],
    //             'lon' => $decodedData['lon'],
    //             'wizytowka' => $wizytowkaList,
    //         ]
    //     );
    // }

   
}
