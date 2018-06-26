<?php

namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/login")
 */
class LoginController extends Controller
{
    /**
     * @Route("/", name="login", methods="GET")
     */
    public function login(): Response
    {
        if(strrpos(get_class(FuncoesController::verificarSessao($this)), "Redirect")) {
            return $this->render('login/index.html.twig');
        }else{
            return $this->redirectToRoute("administracao");
        }
    }

    /**
     * @Route("/logout", name="logout", methods="GET")
     */
    public function logout(): Response
    {
        $session = new Session();
        $session->clear();

        $this->addFlash(
            "Mensagem",
            "Usuário deslogado com sucesso!"
        );

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/verificar", name="verificar", methods="POST")
     */
    public function verificar(Request $request): Response
    {
        $data = (object) $request->request->all();

        $repository = $this->getDoctrine()->getRepository(Usuario::class);

        $user = $repository->findOneBy(
            [
                "login" => $data->login,
                "senha" => FuncoesController::gerarSenha($data->password)
            ]
        );

        if($user){
            $session = new Session();
            $session->clear();
            $session->start();

            $session->set("user", $user);

            $this->addFlash(
                "Mensagem",
                "Login efetuado com sucesso!"
            );

            return $this->redirectToRoute("administracao");
        }else{
            $this->addFlash(
                "Mensagem",
                "Usuário e/ou senha inválidos!"
            );

            return $this->redirectToRoute("login");
        }
    }
}
