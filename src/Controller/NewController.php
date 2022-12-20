<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return new Response('Hi!');
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function TwigAction(string $sraka)
    {
        return $this->render('test.html.twig',[
            'holyshit' => $sraka
        ]);
    }
}