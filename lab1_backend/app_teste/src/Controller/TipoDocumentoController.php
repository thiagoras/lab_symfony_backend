<?php

namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\TipoDocumento;
    use App\Repository\TipoDocumentoRepository;
    

class TipoDocumentoController extends AbstractController
{
    
    #[Route('/tipoDocumentoInit')]
    public function index( TipoDocumentoRepository $tipoDocumentoRepository): Response  {
        $tipoOficio = new TipoDocumento();
        //$tipoOficio.setCategoria("Norma");
        $tipoOficio->categoria = 'Norma';
        
        $tipoDocumentoRepository->save($tipoOficio, true);

        return $this->redirectToRoute('listarTipoDocumento');
    }

    
    #[Route('/listarTipoDocumento',name:"listarTipoDocumento")]
    public function listarTipoDocumento( TipoDocumentoRepository $tipoDocumentoRepository): Response  {

        $tipoDocumentoList = $tipoDocumentoRepository->findAll();

        return $this->render('tipoDocumento/listar.html.twig',[
                'page_title' => 'Lista de Tipos de Documentos',
                'tipoDocumentoList' => $tipoDocumentoList ]);
    }

    #[Route('/editarTipoDocumento',name:"editarTipoDocumento")]
    public function editarTipoDocumento( TipoDocumentoRepository $tipoDocumentoRepository): Response  {

        $tipoDocumento = $tipoDocumentoRepository->findTipoDocumentoById();


        $form = $this->createFormBuilder($tipoDocumento)
            ->add('id', TextType::class)
            ->add('categoria', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Salvar Tipo Documento'])
            ->getForm();

        return $this->render('tipoDocumento/editar.html.twig',[
                'page_title' => 'Editar Tipo de Documentos',
                'form' => $form ]);
    }

    public function novoTipoDocumento(Request $request): Response    {
        
        $tipoDocumento = new TipoDocumento();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('task_success');
        }

        return $this->render('task/new.html.twig', [
            'form' => $form,
        ]);
    }

}