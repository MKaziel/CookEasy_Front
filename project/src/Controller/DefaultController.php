<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class DefaultController extends AbstractController
{
    /**
     * @Route("/co", name="User connection page")
     */
    public function page_connection(){
        return $this->render('UserConnectionPage.html.twig', array());
    }

    /**
     * @Route("/log_in", name="User connection function")
     */
    public function user_connection() {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $client = HttpClient::create();

        $options = [
            'salt' => 10
        ];

        $response = $client->request('POST', 'http://'.$_ENV['IPV4'].':3000/users/login', [
            'body' => [
                'login' => $login,
                'password' => $password
            ]
        ]);

        if($response->getStatusCode() === 200){
            //Execution quand un utilisateur a réussi à se connecter
            echo("Réussi");
            return $this->render('UserConnectionPage.html.twig', array());
        } else {
            //Execution quand la connexion a échoué
            echo("Loupé");
            return $this->render('UserConnectionPage.html.twig', array());
        }
    }
}