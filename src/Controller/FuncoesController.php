<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FuncoesController extends Controller
{
    public function gerarSenha(String $senha): String
    {
        return $senha;
    }
}
