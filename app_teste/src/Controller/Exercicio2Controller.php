<?php

namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

class Exercicio2Controller extends AbstractController
{

    
    #[Route('/exercicio2/{numero}')]
    public function index( int $numero): Response
    {
        $numAdicao = $numero + $numero;
        $numMenos = $numero - $numero;
        $numMult = $numero * $numero;
        $numDiv = $numero / $numero;
        return $this->render('exercicio2/exercicio2.html.twig', ['numero' => $numero, 'page_title' => 'exercicio 2',
                                'numAdicao' => $numAdicao, 
                                'numMenos' => $numMenos,
                                'numMult' => $numMult,
                                'numDiv' => $numDiv]);
    }
}