<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CadastrarController extends Controller
{
    /**
     * @Route("/cadastrar", name="cadastrar")
     */
    public function index()
    {
        return $this->render('cadastrar/index.html.twig', [
            'controller_name' => 'CadastrarController',
        ]);
    }
}
