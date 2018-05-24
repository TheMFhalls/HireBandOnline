<?php

namespace App\Controller;

use App\Entity\EnderecoEletronico;
use App\Form\EnderecoEletronicoType;
use App\Repository\EnderecoEletronicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/endereco/eletronico")
 */
class EnderecoEletronicoController extends Controller
{
    /**
     * @Route("/", name="endereco_eletronico_index", methods="GET")
     */
    public function index(EnderecoEletronicoRepository $enderecoEletronicoRepository): Response
    {
        return $this->render('endereco_eletronico/index.html.twig', ['endereco_eletronicos' => $enderecoEletronicoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="endereco_eletronico_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $enderecoEletronico = new EnderecoEletronico();
        $form = $this->createForm(EnderecoEletronicoType::class, $enderecoEletronico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enderecoEletronico);
            $em->flush();

            return $this->redirectToRoute('endereco_eletronico_index');
        }

        return $this->render('endereco_eletronico/new.html.twig', [
            'endereco_eletronico' => $enderecoEletronico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="endereco_eletronico_show", methods="GET")
     */
    public function show(EnderecoEletronico $enderecoEletronico): Response
    {
        return $this->render('endereco_eletronico/show.html.twig', ['endereco_eletronico' => $enderecoEletronico]);
    }

    /**
     * @Route("/{id}/edit", name="endereco_eletronico_edit", methods="GET|POST")
     */
    public function edit(Request $request, EnderecoEletronico $enderecoEletronico): Response
    {
        $form = $this->createForm(EnderecoEletronicoType::class, $enderecoEletronico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('endereco_eletronico_edit', ['id' => $enderecoEletronico->getId()]);
        }

        return $this->render('endereco_eletronico/edit.html.twig', [
            'endereco_eletronico' => $enderecoEletronico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="endereco_eletronico_delete", methods="DELETE")
     */
    public function delete(Request $request, EnderecoEletronico $enderecoEletronico): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enderecoEletronico->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($enderecoEletronico);
            $em->flush();
        }

        return $this->redirectToRoute('endereco_eletronico_index');
    }
}
