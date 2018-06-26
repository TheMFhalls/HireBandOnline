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
        $mensagem = "Você deve logar para ter acesso a administração do site!";
        if(strrpos(get_class($session = FuncoesController::verificarSessao($this, $mensagem)), "Redirect")) {
            return $session;
        }

        return $this->render('administracao/index.html.twig', [
            'controller_name' => 'AdministracaoController',
            'usuario' => $session->get("user")
        ]);
    }
}
