<?php

namespace App\Controller;

use App\Message\Command\SaveOrder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StockTransactionController extends AbstractController
{
    // buy
    #[Route('/buy', name: 'buy-stock')]
    public function buy(MessageBusInterface $bus): Response
    {
        // $notification->getOrder()->getBuyer()->getEmail()
        // $order = new class {
        //    public function getId()
        //    {
        //        return \uniqid();
        //    }
        //    public function getBuyer(): object
        //    {
        //        return new class {
        //            public function getEmail(): string
        //            {
        //                return 'email@gmail.com';
        //            }
        //        };
        //    }
        // };


        // 1. Dispatch confirmation message
        // $bus->dispatch(new PurchaseConfirmationNotification($order->getId()));
        $bus->dispatch(new SaveOrder());

        // 2. Display confirmation to the user
        return $this->render('stocks/example.html.twig');
    }


    // sell
}
