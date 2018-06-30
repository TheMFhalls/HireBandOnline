<?php

namespace App\Controller;

use App\Repository\EstabelecimentoRepository;
use App\Repository\MusicoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/buscar")
 */
class BuscarController extends Controller
{
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
     * @Route("/musico/filtro", name="buscar_musico_filtro")
     */
    public function buscarMusicoFiltro(MusicoRepository $musicoRepository, Request $request): Response
    {
        $data = (object) $request->request->all();

        if($data->nome != "" && $data->categoria == ""){
            $musicos = $musicoRepository->createQueryBuilder("musico")
                ->where("musico.nome LIKE :nome")
                ->setParameter("nome", "%".$data->nome."%")
                ->getQuery()
                ->getResult();
        }elseif($data->nome == "" && $data->categoria != ""){
            $musicos = $musicoRepository->createQueryBuilder("mus")
                ->innerJoin("mus.categoria", "cat")
                ->where("cat.id = :categoria")
                ->setParameter("categoria", $data->categoria)
                ->getQuery()
                ->getResult();
        }elseif($data->nome != "" && $data->categoria != ""){
            $musicos = $musicoRepository->createQueryBuilder("mus")
                ->innerJoin("mus.categoria", "cat")
                ->where("cat.id = :categoria")
                ->andWhere("mus.nome LIKE :nome")
                ->setParameter("categoria", $data->categoria)
                ->setParameter("nome", "%".$data->nome."%")
                ->getQuery()
                ->getResult();
        }else{
            $this->addFlash(
                "Mensagem",
                "Erro ao realizar a busca!"
            );

            return $this->redirectToRoute("buscar_musico");
        }

        return $this->render('buscar/buscarMusico.html.twig', [
            'musicos' => $musicos,
            'filtro' => $data
        ]);
    }

    /**
     * @Route("/estabelecimento/filtro", name="buscar_estabelecimento_filtro")
     */
    public function buscarEstabelecimentoFiltro(EstabelecimentoRepository $estabelecimentoRepository, Request $request): Response
    {
        $data = (object) $request->request->all();

        if($data->nome != "" && $data->bairro == ""){
            $estabelecimentos = $estabelecimentoRepository->createQueryBuilder("musico")
                ->where("musico.nome LIKE :nome")
                ->setParameter("nome", "%".$data->nome."%")
                ->getQuery()
                ->getResult();
        }elseif($data->nome == "" && $data->bairro != ""){
            $estabelecimentos = $estabelecimentoRepository->createQueryBuilder("mus")
                ->innerJoin("mus.categoria", "cat")
                ->where("cat.id = :categoria")
                ->setParameter("categoria", $data->bairro)
                ->getQuery()
                ->getResult();
        }elseif($data->nome != "" && $data->bairro != ""){
            $estabelecimentos = $estabelecimentoRepository->createQueryBuilder("mus")
                ->innerJoin("mus.categoria", "cat")
                ->where("cat.id = :categoria")
                ->andWhere("mus.nome LIKE :nome")
                ->setParameter("categoria", $data->bairro)
                ->setParameter("nome", "%".$data->nome."%")
                ->getQuery()
                ->getResult();
        }else{
            $this->addFlash(
                "Mensagem",
                "Erro ao realizar a busca!"
            );

            return $this->redirectToRoute("buscar_estabelecimento");
        }

        return $this->render('buscar/buscarEstabelecimento.html.twig', [
            'estabelecimentos' => $estabelecimentos,
            'filtro' => $data
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
