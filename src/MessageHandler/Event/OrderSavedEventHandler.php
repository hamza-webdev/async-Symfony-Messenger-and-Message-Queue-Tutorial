<?php

namespace App\MessageHandler\Event;

use Mpdf\Mpdf;
use Symfony\Component\Mime\Email;
use App\Message\Event\OrderSavedEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class OrderSavedEventHandler implements MessageHandlerInterface
{
     public function __construct(private MailerInterface $mailer)
    {

    }

    public function __invoke(OrderSavedEvent $event)
    {
        // 1 . Create a PDF Contract note
        echo '1. Creationg a PDF contract note <br>';

        $mpdf = new Mpdf();
        $content = "<h1>Contrat Note for order {$event->getOrderId()}</h1>";
        $content .= '<p>Total: <b>$ 2599.99</b></p>';

        $mpdf->WriteHTML($content);
        // Output a PDF file directly to the browser
        $contratNotePdf = $mpdf->Output('', 'S');



        //  2. Email the contract note to the buyer
        // echo '2. Emailing contract note to '. $notification->getOrder()->getBuyer()->getEmail(). '<br>';



        $email = (new Email())
        ->from('sales@stock.com')
        ->to('hamza@gmail.com')
        ->subject('Contract note of order '.$event->getOrderId())
        ->text('Here is your contrat note')
        ->attach($contratNotePdf, 'contrat-note.pdf')
        ;

        $this->mailer->send($email);

    }


}
