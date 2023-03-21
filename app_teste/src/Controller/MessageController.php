<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ProcessoController;

class MessageController extends AbstractController
{





    #[Route('/message', name: 'app_message')]
    public function index(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new SmsNotification('Teste mensagem 1'));

        return new Response(
            '<html><body>Sucesso</body></html>'
        );
    }


    #[Route('/message/{novaMessage}', name: 'app_message_nova')]
    public function novaMensagem(MessageBusInterface $bus, string $novaMessage): Response
    {
        $bus->dispatch(new SmsNotification($novaMessage));

        return new Response(
            '<html><body>Sucesso</body></html>'
        );
    }
}
