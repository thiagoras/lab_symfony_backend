<?php

namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

class TesteController
{
    #[Route('/teste')]
    public function index(): Response
    {
        $n = rand();

        return new Response(
            '<html><body>Número aleatório: '.$n.'</body></html>'
        );
    }
}