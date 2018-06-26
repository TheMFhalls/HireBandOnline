<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class AdministracaoController extends Controller
{
    /**
     * @Route("/", name="administracao")
     */
    public function index()
    {
        if(strrpos(get_class($session = FuncoesController::verificarSessao($this)), "Redirect")) {
            return $session;
        }

        return $this->render('administracao/index.html.twig', [
            'controller_name' => 'AdministracaoController',
            'usuario' => $session->get("user")
        ]);
    }
}
