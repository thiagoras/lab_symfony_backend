<?php

namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Documento;
    use App\Repository\DocumentoRepository;
    use App\Repository\TipoDocumentoRepository;
    

class DocumentoController extends AbstractController
{
    
    #[Route('/documentoTeste')]
    public function index( DocumentoRepository $documentoRepository): Response  {
        $documento = new Documento();
        
        $documento->setDescricao('Segundo documento');
        $documento->setNumero(123456);
        $documento->setAutor('SECOM2');
        $documento->setObservacao('Documento sem informação');

        $tipoDocumento = TipoDocumentoRepository.


        $documentoRepository->save($documento, true);

        return $this->redirectToRoute('listarDocumentos');
    }

    #[Route('/listarDocumentos',name:"listarDocumentos")]
    public function listarDocumentos( DocumentoRepository $documentoRepository): Response  {

        $documentoList = $documentoRepository->findAll();

        return $this->render('exercicio2/documentos.html.twig',[
                'page_title' => 'Lista de Documento',
                'documentoList' => $documentoList ]);
    }


}