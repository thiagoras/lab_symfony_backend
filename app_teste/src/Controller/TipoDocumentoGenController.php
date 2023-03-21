<?php

namespace App\Controller;

use App\Entity\TipoDocumento;
use App\Form\TipoDocumento1Type;
use App\Repository\TipoDocumentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tipo/documento/controller/gen')]
class TipoDocumentoGenController extends AbstractController
{
    #[Route('/', name: 'app_tipo_documento_controller_gen_index', methods: ['GET'])]
    public function index(TipoDocumentoRepository $tipoDocumentoRepository): Response
    {
        return $this->render('tipo_documento_controller_gen/index.html.twig', [
            'tipo_documentos' => $tipoDocumentoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tipo_documento_controller_gen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TipoDocumentoRepository $tipoDocumentoRepository): Response
    {
        $tipoDocumento = new TipoDocumento();
        $form = $this->createForm(TipoDocumento1Type::class, $tipoDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tipoDocumentoRepository->save($tipoDocumento, true);

            return $this->redirectToRoute('app_tipo_documento_controller_gen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tipo_documento_controller_gen/new.html.twig', [
            'tipo_documento' => $tipoDocumento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_documento_controller_gen_show', methods: ['GET'])]
    public function show(TipoDocumento $tipoDocumento): Response
    {
        return $this->render('tipo_documento_controller_gen/show.html.twig', [
            'tipo_documento' => $tipoDocumento,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tipo_documento_controller_gen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TipoDocumento $tipoDocumento, TipoDocumentoRepository $tipoDocumentoRepository): Response
    {
        $form = $this->createForm(TipoDocumento1Type::class, $tipoDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tipoDocumentoRepository->save($tipoDocumento, true);

            return $this->redirectToRoute('app_tipo_documento_controller_gen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tipo_documento_controller_gen/edit.html.twig', [
            'tipo_documento' => $tipoDocumento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_documento_controller_gen_delete', methods: ['POST'])]
    public function delete(Request $request, TipoDocumento $tipoDocumento, TipoDocumentoRepository $tipoDocumentoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoDocumento->getId(), $request->request->get('_token'))) {
            $tipoDocumentoRepository->remove($tipoDocumento, true);
        }

        return $this->redirectToRoute('app_tipo_documento_controller_gen_index', [], Response::HTTP_SEE_OTHER);
    }
}
