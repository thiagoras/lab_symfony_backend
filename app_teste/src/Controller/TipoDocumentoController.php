<?php

namespace App\Controller;

    use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Doctrine\ORM\EntityManagerInterface;

    use App\Entity\TipoDocumento;
    use App\Repository\TipoDocumentoRepository;
    use App\Form\TipoDocumentoType;
    
    #[Route('/tipoDocumento/',name:"tipoDocumento")]

class TipoDocumentoController extends AbstractController
{
    
    #[Route('init', name:"app_tipoDocumento_init")]
    public function index( TipoDocumentoRepository $tipoDocumentoRepository): Response  {
        $tipoOficio = new TipoDocumento();
        //$tipoOficio.setCategoria("Norma");
        $tipoOficio->setCategoria('Cartilha');
        
        $tipoDocumentoRepository->save($tipoOficio, true);

        return $this->redirect('listar');
    }

    
    #[Route('listar',name:"app_tipoDocumento_listar")]
    public function listarTipoDocumento( TipoDocumentoRepository $tipoDocumentoRepository): Response  {

        $tipoDocumentoList = $tipoDocumentoRepository->findAll();

        return $this->render('tipoDocumento/listar.html.twig',[
                'page_title' => 'Lista de Tipos de Documentos',
                'tipoDocumentoList' => $tipoDocumentoList ]);
    }

    #[Route('editar',name:"app_tipoDocumento_editar")]
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

    #[Route('/novoTipoDocumento',name:"novoTipoDocumento")]
    public function novoTipoDocumento(Request $request, 
                        TipoDocumentoRepository $tipoDocumentoRepository,
                        EntityManagerInterface $entityManager): Response
    {
        $tipoDocumento = new TipoDocumento();
        
        $form = $this->createForm(TipoDocumentoType::class, $tipoDocumento);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tipoDocumento);
            $entityManager->flush();
            //$tipoDocumentoRepository->add($tipoDocumento);
            return $this->redirectToRoute('listarTipoDocumento');
        }


        return $this->render('tipoDocumento/new.html.twig', [
                'form' => $form,
            ]);
    }

}