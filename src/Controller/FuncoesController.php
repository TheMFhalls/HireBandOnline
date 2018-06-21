<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

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
}
