<?php

namespace App\Controller;

use App\Entity\Cidade;
use App\Entity\Estado;
use App\Repository\EstadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/json")
 */
class JsonController extends Controller
{
    /**
     * @Route("/estados/lista", methods="GET")
     */
    public function estadosJson(EstadoRepository $estadoRepository): Response
    {
        $json = [];
        foreach($estadoRepository->findAll() as $estado){
            $json[] = [
                "id"    => $estado->getId(),
                "nome"  => $estado->getNome()
            ];
        }

        $response = new Response(json_encode($json));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/estado/{id}/cidades", methods="GET")
     */
    public function cidadesJson($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Estado::class);

        $estado = $repository->find($id);

        $json = [];
        foreach($estado->getCidades() as $cidade){
            $json[] = [
                "id"    => $cidade->getId(),
                "nome"  => $cidade->getNome()
            ];
        }

        $response = new Response(json_encode($json));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/cidade/{id}/bairros", methods="GET")
     */
    public function bairrosJson($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Cidade::class);

        $cidade = $repository->find($id);

        $json = [];
        foreach($cidade->getBairros() as $bairro){
            $json[] = [
                "id"    => $bairro->getId(),
                "nome"  => $bairro->getNome()
            ];
        }

        $response = new Response(json_encode($json));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}