<?php

namespace App\Controller;

use App\Repository\EstabelecimentoRepository;
use App\Repository\MusicoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/buscar")
 */
class BuscarController extends Controller
{
    /**
     * @Route("/buscar", name="buscar")
     */
    public function index()
    {
        return $this->render('buscar/index.html.twig', [
            'controller_name' => 'BuscarController',
        ]);
    }

    /**
     * @Route("/musico", name="buscar_musico")
     */
    public function buscarMusico(MusicoRepository $musicoRepository): Response
    {
        return $this->render('buscar/buscarMusico.html.twig', [
            'musicos' => $musicoRepository->findAll()
        ]);
    }

    /**
     * @Route("/estabelecimento", name="buscar_estabelecimento")
     */
    public function buscarEstabelecimento(EstabelecimentoRepository $estabelecimentoRepository): Response
    {
        return $this->render('buscar/buscarEstabelecimento.html.twig', [
            'estabelecimentos' => $estabelecimentoRepository->findAll()
        ]);
    }
}
