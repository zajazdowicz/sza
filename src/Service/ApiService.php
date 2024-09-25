<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class ApiService
{
   public function __construct() {

   }
    public function getPost(array $param = null): string
    {
        $client = HttpClient::create();
        $response = $client->request('POST', 'https://modelslab.com/api/v6/image_editing/removebg_mask', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],'json' => [
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
        $response = $client->request('GET', 'https://nominatim.openstreetmap.org/search?city='. $city .'&format=json', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],'json' => [
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        return $response->toArray();
    }
        public function getPunkt(string $latMin, string $lonMin, string $latMax, string $lonMax): array
    {

        $client = HttpClient::create();
        $response = $client->request('GET', 'https://overpass-api.de/api/interpreter?data=[out:json];node["amenity"="restaurant"](' . $latMin .','. $lonMin .','. $latMax .',' . $lonMax .');out;', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],'json' => [
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        return $response->toArray();
    }
}
