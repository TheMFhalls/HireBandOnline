<?php

namespace App\Controller;

use App\Entity\Foto;
use App\Entity\Musico;
use App\Form\MusicoType;
use App\Repository\MusicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/musico")
 */
class MusicoController extends Controller
{
//    /**
//     * @Route("/", name="musico_index", methods="GET")
//     */
//    public function index(MusicoRepository $musicoRepository): Response
//    {
//        return $this->render('musico/index.html.twig', ['musicos' => $musicoRepository->findAll()]);
//    }

//    /**
//     * @Route("/new", name="musico_new", methods="GET|POST")
//     */
//    public function new(Request $request): Response
//    {
//        $musico = new Musico();
//        $form = $this->createForm(MusicoType::class, $musico);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($musico);
//            $em->flush();
//
//            return $this->redirectToRoute('musico_index');
//        }
//
//        return $this->render('musico/new.html.twig', [
//            'musico' => $musico,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="musico_show", methods="GET")
     */
    public function show(Musico $musico): Response
    {
        $fotos = $this->getDoctrine()->getRepository(Foto::class)
            ->findBy([
                "usuario" => $musico->getUsuario()
            ]);

        return $this->render('musico/show.html.twig', [
            'musico' => $musico,
            'fotos' => $fotos
        ]);
    }

//    /**
//     * @Route("/{id}/edit", name="musico_edit", methods="GET|POST")
//     */
//    public function edit(Request $request, Musico $musico): Response
//    {
//        $form = $this->createForm(MusicoType::class, $musico);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('musico_edit', ['id' => $musico->getId()]);
//        }
//
//        return $this->render('musico/edit.html.twig', [
//            'musico' => $musico,
//            'form' => $form->createView(),
//        ]);
//    }

//    /**
//     * @Route("/{id}", name="musico_delete", methods="DELETE")
//     */
//    public function delete(Request $request, Musico $musico): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$musico->getId(), $request->request->get('_token'))) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($musico);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('musico_index');
//    }
}
