<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\Session;

class FuncoesController extends Controller
{
    /**
     * @param String $senha
     * @param int $controle
     * @return String
     */
    public static function gerarSenha(String $senha, $controle = 139): String
    {
        if(empty($senha) || is_null($senha)){
            throw new Exception("A senha informada não pode ser vazia!");
        }

        $senha = base64_encode($senha);
        $senha = md5($senha);

        if($controle != 0){
            return self::gerarSenha($senha, $controle-1);
        }

        return $senha;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Session
     */
    public static function verificarSessao($obj, $mensagem = null)
    {
        $session = new Session();

        if($session->has("user")){
            return $session;
        }else{
            if($mensagem != null){
                $obj->addFlash("Mensagem", $mensagem);
            }

            return $obj->redirectToRoute("login");
        }
    }
}
