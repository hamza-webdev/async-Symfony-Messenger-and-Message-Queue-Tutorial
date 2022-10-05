<?php

namespace App\MessageHandler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Undocumented class
 * @author Hamza
 * @version 1.0
 *  In php 8 we can use replace implements MessageHandlerInterface  => #[AsMessageHandler]
 */
class PurchaseConfirmationNotificationHandler implements MessageHandlerInterface
{
    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        // 1 . Create a PDF Contract note
        echo ' Creationg a PDF contract note';

        //  2. Email the contract note to the buyer
        echo 'Emailing contract note to '. $notification->getOrder()->getBuyer()->getEmail(). '<br>';

    }

}
