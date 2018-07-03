<?php

namespace App\Controller;

use App\Entity\Foto;
use App\Entity\Usuario;
use App\Form\FotoType;
use App\Repository\FotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/foto")
 */
class FotoController extends Controller
{
    /**
     * @Route("/", name="foto_index", methods="GET")
     */
    public function index(FotoRepository $fotoRepository): Response
    {
        $fotos = $fotoRepository->findBy([
            "usuario" => FuncoesController::getSessionObject("user")->getId()
        ]);

        return $this->render('foto/index.html.twig', ['fotos' => $fotos]);
    }

    /**
     * @Route("/new", name="foto_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        if($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();

            $data = (object) $request->request->all();

            $foto = new Foto();

            $usuario = $em->getRepository(Usuario::class)
                ->findOneBy([
                    "id" => FuncoesController::getSessionObject("user")->getId()
                ]);

            $foto->setDescricao($data->descricao);
            $foto->setDiretorio(
                FuncoesController::converterImagem($request->files->get("imagem"))
            );
            $foto->setUsuario($usuario);

            $em->persist($foto);
            $em->flush();

            $this->addFlash(
                "Mensagem",
                "Foto inserida com sucesso!"
            );

            return $this->redirectToRoute("foto_index");
        }

        return $this->render('foto/new.html.twig');
    }

//    /**
//     * @Route("/{id}", name="foto_show", methods="GET")
//     */
//    public function show(Foto $foto): Response
//    {
//        return $this->render('foto/show.html.twig', ['foto' => $foto]);
//    }

//    /**
//     * @Route("/{id}/edit", name="foto_edit", methods="GET|POST")
//     */
//    public function edit(Request $request, Foto $foto): Response
//    {
//        $form = $this->createForm(FotoType::class, $foto);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('foto_edit', ['id' => $foto->getId()]);
//        }
//
//        return $this->render('foto/edit.html.twig', [
//            'foto' => $foto,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="foto_delete", methods="DELETE")
     */
    public function delete(Request $request, Foto $foto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$foto->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($foto);
            $em->flush();
        }

        return $this->redirectToRoute('foto_index');
    }
}
