<?php

namespace App\Controller;

use App\Entity\Telefone;
use App\Form\TelefoneType;
use App\Repository\TelefoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/telefone")
 */
class TelefoneController extends Controller
{
    /**
     * @Route("/", name="telefone_index", methods="GET")
     */
    public function index(TelefoneRepository $telefoneRepository): Response
    {
        return $this->render('telefone/index.html.twig', ['telefones' => $telefoneRepository->findAll()]);
    }

    /**
     * @Route("/new", name="telefone_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $telefone = new Telefone();
        $form = $this->createForm(TelefoneType::class, $telefone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($telefone);
            $em->flush();

            return $this->redirectToRoute('telefone_index');
        }

        return $this->render('telefone/new.html.twig', [
            'telefone' => $telefone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="telefone_show", methods="GET")
     */
    public function show(Telefone $telefone): Response
    {
        return $this->render('telefone/show.html.twig', ['telefone' => $telefone]);
    }

    /**
     * @Route("/{id}/edit", name="telefone_edit", methods="GET|POST")
     */
    public function edit(Request $request, Telefone $telefone): Response
    {
        $form = $this->createForm(TelefoneType::class, $telefone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('telefone_edit', ['id' => $telefone->getId()]);
        }

        return $this->render('telefone/edit.html.twig', [
            'telefone' => $telefone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="telefone_delete", methods="DELETE")
     */
    public function delete(Request $request, Telefone $telefone): Response
    {
        if ($this->isCsrfTokenValid('delete'.$telefone->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($telefone);
            $em->flush();
        }

        return $this->redirectToRoute('telefone_index');
    }
}
