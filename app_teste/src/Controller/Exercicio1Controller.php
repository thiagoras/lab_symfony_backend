<?php

namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

class Exercicio1Controller extends AbstractController
{
    #[Route('/exercicio1/{numero}')]
    public function index( int $numero): Response
    {
        
        //$request = $this->getRequest();
        //$n= $request->request->get('numero'); 
        $resto = $numero%2;
        $restostr;
        if($resto == 0){
            $restostr="par";
        }else{
            $restostr="impar";
        }

        return new Response(
            '<html>
                <body>
                    Número parametrizado: '.$numero.' <br>
                    Impar ou par:: ' .$restostr .'
                    
                </body>
            </html>'
        );
    }
}