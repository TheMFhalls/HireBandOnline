<?php

namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login", methods="GET")
     */
    public function index()
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController'
        ]);
    }

    /**
     * @Route("/verificar", name="verificar", methods="POST")
     */
    public function verificar(Request $request): Response
    {
        $data = (object) $request->request->all();

        $repository = $this->getDoctrine()->getRepository(Usuario::class);

        $users = $repository->findBy(
            [
                "login" => $data->login,
                "senha" => $data->password
            ]
        );

        if(count($users) != 1){
            $this->addFlash(
                "Mensagem",
                "Usuáriou e/ou senha inválidos!"
            );

            return $this->redirectToRoute("login");
        }else{

        }
    }
}
