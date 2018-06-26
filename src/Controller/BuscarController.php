<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BuscarController extends Controller
{
    /**
     * @Route("/buscar", name="buscar")
     */
    public function index()
    {
        return $this->render('buscar/index.html.twig', [
            'controller_name' => 'BuscarController',
        ]);
    }
}
