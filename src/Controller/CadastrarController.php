<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/cadastrar")
 */
class CadastrarController extends Controller
{
    /**
     * @Route("/", name="cadastrar", methods="GET")
     */
    public function index()
    {
        return $this->render('cadastrar/index.html.twig', [
            'controller_name' => 'CadastrarController',
        ]);
    }


    /**
     * @Route("/new", name="cadastrar_new", methods="POST")
     */
    public function new(Request $request)
    {

    }
}
