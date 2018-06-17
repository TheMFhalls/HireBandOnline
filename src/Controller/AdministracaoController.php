<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministracaoController extends Controller
{
    /**
     * @Route("/administracao", name="administracao")
     */
    public function index()
    {
        return $this->render('administracao/index.html.twig', [
            'controller_name' => 'AdministracaoController',
        ]);
    }
}
