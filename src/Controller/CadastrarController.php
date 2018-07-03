<?php

namespace App\Controller;

use App\Entity\Bairro;
use App\Entity\Categoria;
use App\Entity\Estabelecimento;
use App\Entity\Foto;
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
                $musico = $this->addMusico(
                    $data,
                    $usuario,
                    $em,
                    $request
                );

                $categorias = $doctrine->getRepository(Categoria::class)
                    ->findBy(["id" => $data->categorias]);

                foreach($categorias as $categoria){
                    $musico->addCategorium($categoria);
                }

                $em->persist($musico);
            }else if($data->tipo == "estabelecimento"){
                $estabelecimento = $this->addEstabelecimento(
                    $data,
                    $usuario,
                    $doctrine,
                    $em,
                    $request
                );
            }else{
                throw new Exception("Informe um tipo de usuário!");
            }

            $em->flush();
            $doctrine->getConnection()->commit();

            $this->addFlash(
                "Mensagem",
                "Usuário cadastrado com sucesso!"
            );

            return $this->redirectToRoute("home");
        }catch(\Exception $e){
            $doctrine->getConnection()->rollBack();

            $this->addFlash(
                "Mensagem",
                "Erro no cadastro de usuário (".$e->getMessage().")"
            );

            return $this->redirectToRoute("cadastrar");
        }
    }

    /**
     * @param $data
     * @param $usuario
     * @param $em
     * @return Musico
     */
    private function addMusico($data, $usuario, $em, Request $request): Musico
    {
        $musico = new Musico();

        $musico->setNome($data->nome_musico);
        $musico->setHistoria($data->historia_musico);
        $musico->setUsuario($usuario);
        $musico->setImagem(
            FuncoesController::converterImagem($request->files->get("imagem_perfil"))
        );

        $em->persist($musico);

        return $musico;
    }

    /**
     * @param $data
     * @param $usuario
     * @param $doctrine
     * @param $em
     * @return Estabelecimento
     */
    private function addEstabelecimento($data, $usuario, $doctrine, $em, Request $request): Estabelecimento
    {
        $estabelecimento = new Estabelecimento();

        $estabelecimento->setNome($data->nome_estabelecimento);
        $estabelecimento->setHistoria($data->historia_estabelecimento);
        $estabelecimento->setUsuario($usuario);
        $estabelecimento->setEndereco($data->endereco);
        $estabelecimento->setBairro(
            $doctrine->getRepository(Bairro::class)
                ->find($data->bairro)
        );

        if($request->files->get("imagem_perfil") != null){
            $estabelecimento->setImagem(
                FuncoesController::converterImagem($request->files->get("imagem_perfil"))
            );
        }

        $em->persist($estabelecimento);

        return $estabelecimento;
    }
}