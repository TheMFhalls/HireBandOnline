<?php

namespace App\Controller;

use App\Entity\Estado;
use App\Form\EstadoType;
use App\Repository\EstadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/estado")
 */
class EstadoController extends Controller
{
    /**
     * @Route("/", name="estado_index", methods="GET")
     */
    public function index(EstadoRepository $estadoRepository): Response
    {
        return $this->render('estado/index.html.twig', ['estados' => $estadoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="estado_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $estado = new Estado();
        $form = $this->createForm(EstadoType::class, $estado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estado);
            $em->flush();

            return $this->redirectToRoute('estado_index');
        }

        return $this->render('estado/new.html.twig', [
            'estado' => $estado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estado_show", methods="GET")
     */
    public function show(Estado $estado): Response
    {
        return $this->render('estado/show.html.twig', ['estado' => $estado]);
    }

    /**
     * @Route("/{id}/edit", name="estado_edit", methods="GET|POST")
     */
    public function edit(Request $request, Estado $estado): Response
    {
        $form = $this->createForm(EstadoType::class, $estado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estado_edit', ['id' => $estado->getId()]);
        }

        return $this->render('estado/edit.html.twig', [
            'estado' => $estado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estado_delete", methods="DELETE")
     */
    public function delete(Request $request, Estado $estado): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estado->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estado);
            $em->flush();
        }

        return $this->redirectToRoute('estado_index');
    }
}
