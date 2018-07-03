<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/video")
 */
class VideoController extends Controller
{
    /**
     * @Route("/", name="video_index", methods="GET")
     */
    public function index(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy([
            "usuario" => FuncoesController::getSessionObject("user")->getId()
        ]);

        return $this->render('video/index.html.twig', ['videos' => $videos]);
    }

    /**
     * @Route("/new", name="video_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        if($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();

            $data = (object) $request->request->all();

            $video = new Video();

            $usuario = $em->getRepository(Usuario::class)
                ->findOneBy([
                    "id" => FuncoesController::getSessionObject("user")->getId()
                ]);

            $video->setTitulo($data->titulo);
            $video->setDescricao($data->descricao);
            $video->setUrl(preg_replace(
                "/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                "//www.youtube.com/embed/$1",
                $data->url
            ));
            $video->setUsuario($usuario);

            $em->persist($video);
            $em->flush();

            $this->addFlash(
                "Mensagem",
                "Vídeo inserido com sucesso!"
            );

            return $this->redirectToRoute("video_index");
        }

        return $this->render('video/new.html.twig');
    }

//    /**
//     * @Route("/{id}", name="video_show", methods="GET")
//     */
//    public function show(Video $video): Response
//    {
//        return $this->render('video/show.html.twig', ['video' => $video]);
//    }

//    /**
//     * @Route("/{id}/edit", name="video_edit", methods="GET|POST")
//     */
//    public function edit(Request $request, Video $video): Response
//    {
//        $form = $this->createForm(VideoType::class, $video);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('video_edit', ['id' => $video->getId()]);
//        }
//
//        return $this->render('video/edit.html.twig', [
//            'video' => $video,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="video_delete", methods="DELETE")
     */
    public function delete(Request $request, Video $video): Response
    {
        if ($this->isCsrfTokenValid('delete'.$video->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush();
        }

        return $this->redirectToRoute('video_index');
    }
}
