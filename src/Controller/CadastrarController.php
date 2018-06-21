<?php

namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
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
    public function new(Request $request): Response
    {
        $data = (object) $request->request->all();
        $doctrine = $this->getDoctrine();

        $doctrine->getConnection()->beginTransaction();
        try{
            $usuario = new Usuario();

            $usuario->setEmail($data->email);
            $usuario->setLogin($data->login);
            $usuario->setSenha($data->senha);
            
            /*
            $doctrine->persist();
            */
            $doctrine->flush();
            $doctrine->getConnection()->commit();
        }catch(Exception $e){
            $doctrine->getConnection()->rollBack();

            $this->addFlash(
                "Mensagem",
                "Erro no cadastro de usuário (".$e->getMessage().")"
            );

            return $this->redirectToRoute("cadastrar");
        }
    }
}
