<?php
// src/MessageHandler/SmsNotificationHandler.php
namespace App\MessageHandler;
use App\Entity\Processo;
use App\Message\SmsNotification;
use App\Repository\ProcessoRepository;
use Monolog\Processor\ProcessIdProcessor;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SmsNotificationHandler
{
    
    public function __construct
        (private ProcessoRepository $processoRepository)
    {   }

    /**
     * Summary of __invoke
     * @param SmsNotification $message
     * @return void
     */
    public function __invoke(SmsNotification $message)
    {
        $processo = new Processo();
        $processo->setDescricao($message->getContent());
        $processo->setNumero(123);
        $processo->setTitulo($message->getContent());
        $processo->setObservacao($message->getContent());
        $processo->setClassificacao($message->getContent());
        $this->processoRepository->save($processo, true);
    }
} 