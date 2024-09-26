<?php

namespace App\Controller;

use App\Entity\POI;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpClient\HttpClient;


class POIimportController extends AbstractController
{
    #[Route('/poi/import', name: 'app_poi_import')]
    public function index(
        EntityManagerInterface $entityManager
    ): Response {
        $httpClient = HttpClient::create();
        $url = 'https://overpass-api.de/api/interpreter';
        $zapytanie = '[out:json][timeout:25];
            area[name="Częstochowa"]->.searchArea;
            (
                node(area.searchArea)["amenity"="restaurant"];
                way(area.searchArea)["amenity"="restaurant"];
                rel(area.searchArea)["amenity"="restaurant"];
            );
            out body;';

        $encodedQuery = 'data=' . urlencode($zapytanie);

        $response = $httpClient->request('POST', $url, [
            'body' => $encodedQuery,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $data = $response->toArray();
            $elements = $data['elements'] ?? [];

            foreach ($elements as $element) {
                //dd($element);
                $poi = new POI();
                $poi->setType($element['type']);
                $poi->setLat(isset($element['lat']) ? (string)$element['lat'] : null);
                $poi->setLon(isset($element['lon']) ? (string)$element['lon'] : null);

                $entityManager->persist($poi);
            }

            $entityManager->flush();

            return $this->render('poi_import/index.html.twig', [
                'controller_name' => 'POIimportController',
                'poi_count' => count($elements),
            ]);
        } else {
            // Handle error case
            return new Response('Failed to retrieve restaurant data: ' . $response->getStatusCode(), 500);
        }
    }
}
