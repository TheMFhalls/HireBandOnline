<?php

namespace App\Controller;

use App\Entity\Estabelecimento;
use App\Form\EstabelecimentoType;
use App\Repository\EstabelecimentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/estabelecimento")
 */
class EstabelecimentoController extends Controller
{
    /**
     * @Route("/", name="estabelecimento_index", methods="GET")
     */
    public function index(EstabelecimentoRepository $estabelecimentoRepository): Response
    {
        return $this->render('estabelecimento/index.html.twig', ['estabelecimentos' => $estabelecimentoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="estabelecimento_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $estabelecimento = new Estabelecimento();
        $form = $this->createForm(EstabelecimentoType::class, $estabelecimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estabelecimento);
            $em->flush();

            return $this->redirectToRoute('estabelecimento_index');
        }

        return $this->render('estabelecimento/new.html.twig', [
            'estabelecimento' => $estabelecimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estabelecimento_show", methods="GET")
     */
    public function show(Estabelecimento $estabelecimento): Response
    {
        return $this->render('estabelecimento/show.html.twig', ['estabelecimento' => $estabelecimento]);
    }

    /**
     * @Route("/{id}/edit", name="estabelecimento_edit", methods="GET|POST")
     */
    public function edit(Request $request, Estabelecimento $estabelecimento): Response
    {
        $form = $this->createForm(EstabelecimentoType::class, $estabelecimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estabelecimento_edit', ['id' => $estabelecimento->getId()]);
        }

        return $this->render('estabelecimento/edit.html.twig', [
            'estabelecimento' => $estabelecimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estabelecimento_delete", methods="DELETE")
     */
    public function delete(Request $request, Estabelecimento $estabelecimento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estabelecimento->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estabelecimento);
            $em->flush();
        }

        return $this->redirectToRoute('estabelecimento_index');
    }
}
