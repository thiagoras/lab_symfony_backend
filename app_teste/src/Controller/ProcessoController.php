<?php

namespace App\Controller;

use App\Entity\Processo;
use App\Form\ProcessoType;
use App\Repository\ProcessoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/processo')]
class ProcessoController extends AbstractController
{
    #[Route('/', name: 'app_processo_index', methods: ['GET'])]
    public function index(ProcessoRepository $processoRepository): Response
    {
        return $this->render('processo/index.html.twig', [
            'processos' => $processoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_processo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProcessoRepository $processoRepository): Response
    {
        $processo = new Processo();
        $form = $this->createForm(ProcessoType::class, $processo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $processoRepository->save($processo, true);

            return $this->redirectToRoute('app_processo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processo/new.html.twig', [
            'processo' => $processo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_processo_show', methods: ['GET'])]
    public function show(Processo $processo): Response
    {
        return $this->render('processo/show.html.twig', [
            'processo' => $processo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_processo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Processo $processo, ProcessoRepository $processoRepository): Response
    {
        $form = $this->createForm(ProcessoType::class, $processo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $processoRepository->save($processo, true);

            return $this->redirectToRoute('app_processo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('processo/edit.html.twig', [
            'processo' => $processo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_processo_delete', methods: ['POST'])]
    public function delete(Request $request, Processo $processo, ProcessoRepository $processoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$processo->getId(), $request->request->get('_token'))) {
            $processoRepository->remove($processo, true);
        }

        return $this->redirectToRoute('app_processo_index', [], Response::HTTP_SEE_OTHER);
    }
}
