<?php

namespace App\MessageHandler\Command;


use App\Message\Command\SaveOrder;
use App\Message\Event\OrderSavedEvent;
use Symfony\Component\Messenger\MessageBusInterface;
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
   /**
    * Undocumented function
    * @param  \Symfony\Component\Messenger\MessageBusInterface $eventBus
    * @author Hamza
    * @version 1.0
    */
    public function __construct(private MessageBusInterface $eventBus)
    {

    }

    public function __invoke(SaveOrder $saveOrder){
        // Save an order to database
        $order = uniqid('bh_');

        echo 'Order being saved ... '. $order. PHP_EOL;

        // Dispatch on event message on an event bus
        $this->eventBus->dispatch(new OrderSavedEvent($order));

    }




}
