<?php

namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Validator\Validator\ValidatorInterface;


    use App\Entity\Documento;
    use App\Repository\DocumentoRepository;
    use App\Repository\TipoDocumentoRepository;
    use App\Form\DocumentoType;

    #[Route('/documento/',name:"documento")]
 

/**
 * Summary of DocumentoController
 */
class DocumentoController extends AbstractController
{


    #[Route('', name: 'app_documento_index')]
    public function index(): Response {
        return $this->redirect('listar');
    }
    
    #[Route('init')]
    public function init( DocumentoRepository $documentoRepository,
        TipoDocumentoRepository $tipoDocumentoRepository): Response  {
        $documento = new Documento();
        
        $documento->setDescricao('Terceiro documento');
        $documento->setNumero(456);
        $documento->setAutor('Thiago');
        $documento->setObservacao('Documento tipado');

        $tipoDoc = $tipoDocumentoRepository->findAll()[0];
        $documento->setTipoDocumento($tipoDoc);
        

        $documentoRepository->save($documento, true);

        return $this->redirectToRoute('listarDocumentos');
    }

    #[Route('listar',name:"app_documento_listar")]
    public function listarDocumentos( DocumentoRepository $documentoRepository): Response  {

        $documentoList = $documentoRepository->findAll();

        // return $this->render('exercicio2/documentos.html.twig',[
        //         'page_title' => 'Lista de Documento',
        //         'documentoList' => $documentoList ]);

        return $this->render('documento/listar.html.twig', [
            'controller_name' => 'DocumentoController',
            'documentos' => $documentoList
        ]);
    }
    #[Route('novo',name:"app_documento_novo")]
    public function novoDocumento(Request $request, 
                        DocumentoRepository $documentoRepository,
                        TipoDocumentoRepository $tipoDocumentoRepository,
                        EntityManagerInterface $entityManager): Response
    {
        $documento = new Documento();
        
        $form = $this->createForm(DocumentoType::class, $documento);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $documentoRepository->save($documento, true);
            // $entityManager->persist($documento);
            // $entityManager->flush();
            //$tipoDocumentoRepository->add($tipoDocumento);
            return $this->redirect('listar');
        }


        return $this->render('documento/_form.html.twig', [
                'form' => $form,
            ]);
    }

    #[Route('alterar/{idDocumento}',name:"app_documento_alterar")]
    /**
     * Summary of alterarDocumento
     * @param Request $request
     * @param DocumentoRepository $documentoRepository
     * @param TipoDocumentoRepository $tipoDocumentoRepository
     * @param EntityManagerInterface $entityManager
     * @param int $idDocumento
     * @return Response
     */
    public function alterarDocumento(Request $request, 
                        DocumentoRepository $documentoRepository,
                        $idDocumento): Response
    {
        if($idDocumento){

            $documento = $documentoRepository->findDocumentoById($idDocumento);
            
            $form = $this->createForm(DocumentoType::class, $documento);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $documentoRepository->save($documento, true);
                // $entityManager->persist($documento);
                // $entityManager->flush();
                //$tipoDocumentoRepository->add($tipoDocumento);
                return $this->redirect('/documento');
            }


            return $this->render('documento/_form.html.twig', [
                    'form' => $form,
                ]);
        }else{
            return $this->redirect('listar');
        }

    }

    #[Route('{idDocumento}', name: 'app_documento_visualizar')]
    public function visualizarDocumento(DocumentoRepository $documentoRepository, 
                                    TipoDocumentoRepository $tipoDocumentoRepository, 
                                    int $idDocumento): Response
    {
        $documento = $documentoRepository->find($idDocumento);

        return $this->render('documento/visualizar.html.twig', [
            'controller_name' => 'DocumentoController',
            'documento' => $documento,
            'idDocumento' => $idDocumento,
        ]);
    }


    #[Route('remover/{idDocumento}',name:"app_documento_remover")]
    public function removerDocumento(Request $request, 
                        DocumentoRepository $documentoRepository,
                        $idDocumento): Response
    {
        

            $documento = $documentoRepository->findDocumentoById($idDocumento);
            
            $documentoRepository->remove($documento, true);

            return $this->redirect('/documento');

    }

}