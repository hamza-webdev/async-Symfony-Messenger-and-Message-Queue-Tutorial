<?php

namespace App\MessageHandler;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Message\PurchaseConfirmationNotification;
use Mpdf\Mpdf;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Undocumented class
 * @author Hamza
 * @version 1.0
 *  In php 8 we can use replace implements MessageHandlerInterface  => #[AsMessageHandler]
 */
class PurchaseConfirmationNotificationHandler implements MessageHandlerInterface
{

    public function __construct(private MailerInterface $mailer)
    {

    }

    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        // 1 . Create a PDF Contract note
        echo '1. Creationg a PDF contract note <br>';

        $mpdf = new Mpdf();
        $content = "<h1>Contrat Note for order {$notification->getOrder()->getId()}</h1>";
        $content .= '<p>Total: <b>$ 2599.99</b></p>';

        $mpdf->WriteHTML($content);
        // Output a PDF file directly to the browser
        $contratNotePdf = $mpdf->Output('', 'S');



        //  2. Email the contract note to the buyer
        // echo '2. Emailing contract note to '. $notification->getOrder()->getBuyer()->getEmail(). '<br>';



        $email = (new Email())
        ->from('sales@stock.com')
        ->to($notification->getOrder()->getBuyer()->getEmail())
        ->subject('Contract note of order '.$notification->getOrder()->getId())
        ->text('Here is your contrat note')
        ->attach($contratNotePdf, 'contrat-note.pdf')
        ;

        $this->mailer->send($email);

    }

}
