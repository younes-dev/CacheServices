<?php

namespace App\Controller;

use App\Service\CacheExample;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedisController extends AbstractController
{

    /**
     * @Route("/redis", name="redis")
     * @param CacheExample $cacheExample
     * @return Response
     * @throws InvalidArgumentException
     */
    public function indexAction(CacheExample $cacheExample)
    {

         return $this->render('redis/index.html.twig', [
            'cache' => [
                'hit' => $cacheExample->get()->isHit(),
            ],
            'controller_name' => 'RedisController'
        ]);
    }

}
