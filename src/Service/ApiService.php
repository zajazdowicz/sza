<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class ApiService
{
    public function __construct() {}
    public function getPost(array $param = null): string
    {
        $client = HttpClient::create();
        $response = $client->request('POST', 'https://modelslab.com/api/v6/image_editing/removebg_mask', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'key' => 'Jui3yhCp3yqcpA8MT3kS9Ts3OI6VlDlJF2tc2kILcGXXvP92xfeCssEjrlsL',
                'seed' => 12345,
                'image' => 'https://ireland.apollo.olxcdn.com/v1/files/rbxl7nvg37313-PL/image;s=1000x700',
                'post_process_mask' => true,
                'only_mask' => false,
                'alpha_matting' => false,
                'webhook' => null,
                'track_id' => null,
            ]
        ]);


        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        return $content;
    }
    public function getCity(string $city = "warszawa"): array
    {
        $client = HttpClient::create();

        try {
            $response = $client->request('GET', 'https://nominatim.openstreetmap.org/search?city=' . $city . '&format=json', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                throw new \Exception('Błąd API: ' . $statusCode);
            }

            return $response->toArray();
        } catch (\Exception $e) {
            error_log('API error: ' . $e->getMessage());
            return [];
        }
    }
    public function getPunkt(string $latMin, string $lonMin, string $latMax, string $lonMax): array
    {

        $client = HttpClient::create();
        $query = '[out:json];node["amenity"="restaurant"](' . $latMin . ',' . $lonMin . ',' . $latMax . ',' . $lonMax . ');out;';
        //$query = '[out:json];node['amenity'='restaurant'](50.7347282,19.0112543,50.8845418,19.2331843);out;';
        $url = "https://overpass-api.de/api/interpreter?data=" .  urldecode($query);

        $response = $client->request('GET', urldecode($url), [
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        return $response->toArray();
    }
}
