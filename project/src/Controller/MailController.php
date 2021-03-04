<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
 
class MailController extends AbstractController
{
    /**
     * @Route("/co", name="User connection page")
     */
    public function connection(){
        return $this->render('UserConnectionPage.html.twig', array());
    }
    /**
     * @Route("/mail", name="mail")
     */
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            ->subject('Test de MailDev')
            ->text('Ceci est un mail de test');
        $mailer->send($email);
 
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }
}