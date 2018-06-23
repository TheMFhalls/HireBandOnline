<?php

namespace App\Controller;

use App\Entity\Bairro;
use App\Entity\Estabelecimento;
use App\Entity\Musico;
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
        $em = $doctrine->getManager();

        $doctrine->getConnection()->beginTransaction();
        try{
            $usuario = new Usuario();

            $usuario->setEmail($data->email);
            $usuario->setLogin($data->login);
            $usuario->setSenha(
                FuncoesController::gerarSenha($data->password)
            );

            $em->persist($usuario);

            if($data->tipo == "musico"){
                $tipoUsuario = new Musico();

                $tipoUsuario->setNome($data->nome_musico);
                $tipoUsuario->setHistoria($data->historia_musico);
                $tipoUsuario->setUsuario($usuario);
            }else if($data->tipo == "estabelecimento"){
                $tipoUsuario = new Estabelecimento();

                $tipoUsuario->setNome($data->nome_estabelecimento);
                $tipoUsuario->setHistoria($data->historia_estabelecimento);
                $tipoUsuario->setBairro(
                    $doctrine->getRepository(Bairro::class)
                        ->find($data->bairro)
                );
                $tipoUsuario->setUsuario($usuario);
                $tipoUsuario->setEndereco($data->endereco);
            }else{
                throw new Exception("Informe um tipo de usuário!");
            }

            $em->persist($tipoUsuario);

            $em->flush();
            $doctrine->getConnection()->commit();

            $this->addFlash(
                "Mensagem",
                "Usuário cadastrado com sucesso!"
            );

            return $this->redirectToRoute("home");
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
