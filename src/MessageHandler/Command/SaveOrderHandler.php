<?php

namespace App\MessageHandler\Command;


use App\Message\Command\SaveOrder;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * SOit on utilise implements MessageHandlerInterface
 * OU
 * #[AsMessageHandler] pour symfony 6.1 ou sup
 */
#[AsMessageHandler]
class SaveOrderHandler implements MessageHandlerInterface
{
    public function __invoke(SaveOrder $saveOrder){
        // Save an order to database
        $order = 123;

        echo 'Order being saved ... '. $order. PHP_EOL;

        // Dispatch on event message on an event bus

    }




}
