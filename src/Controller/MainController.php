<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_homepage', methods: ['GET'])]
    public function homepage(
        StarshipRepository $repository,
        HttpClientInterface $client,
        CacheInterface $issLocationPull
    ): Response {
        $ships = $repository->findAll();
        $myShip = $ships[array_rand($ships)];

        $issData = $issLocationPull->get('iss_data', function (CacheItem $item) use ($client) {
            $item->expiresAfter(3600);
            $response = $client->request(Request::METHOD_GET, 'https://api.wheretheiss.at/v1/satellites/25544');
            return $response->toArray();
        });

        return $this->render('main/homepage.html.twig', [
            'myShip' => $myShip,
            'ships' => $ships,
            'issData' => $issData,
        ]);
    }
}
