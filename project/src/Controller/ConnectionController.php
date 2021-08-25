<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

use function PHPSTORM_META\type;

class ConnectionController extends AbstractController
{

    function userConnected()
    {
        $login = isset($_COOKIE['login_cookeasy']) ? $_COOKIE['login_cookeasy'] : null;
        $token = isset($_COOKIE['token_cookeasy']) ? $_COOKIE['token_cookeasy'] : null;

        if ($login && $token) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * @Route("/disconnect", name="User deconnection system")
    */
    function userDisconnected()
    {
        $login = isset($_COOKIE['login_cookeasy']) ? $_COOKIE['login_cookeasy'] : null;
        $token = isset($_COOKIE['token_cookeasy']) ? $_COOKIE['token_cookeasy'] : null;

        if (($login && $token) || $login || $token) {
            setcookie('login_cookeasy', null, time() - 365243600, '/', null, false, false);
            setcookie('token_cookeasy', null, time() - 365243600, '/', null, false, false);
            return $this->redirectToRoute('User connection page');
        } else {
            return false;
        }
    }

    /**
     * @Route("/co", name="User connection page")
     */
    public function page_connection()
    {
        return $this->render('connexion/UserConnectionPage.html.twig', array());
    }

    /**
     * @Route("/inscription", name="Inscription page")
     */
    public function page_inscription()
    {
        return $this->render('connexion/UserRegister.html.twig', array());
    }

    /**
     * @Route("/log_in", name="User connection function")
     */
    public function user_connection()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $client = HttpClient::create();

        $options = [
            'salt' => 10
        ];

        $response = $client->request('POST', 'http://' . $_ENV['IPV4'] . ':3000/users/login', [
            'body' => [
                'login' => $login,
                'password' => $password
            ]
        ]);


        if ($response->getStatusCode() === 200) {
            //Execution quand un utilisateur a réussi à se connecter
            $content = json_decode($response->getContent(), true);
            setcookie('login_cookeasy', $content["userLogin"], time() + 365243600, '/', null, false, false);
            setcookie('token_cookeasy', $content["userToken"], time() + 365243600, '/', null, false, false);
            return $this->redirectToRoute("Accueil");
        } else {
            //Execution quand la connexion a échoué
            echo ("Loupé");
            return $this->render('connexion/UserConnectionPage.html.twig', array());
        }
    }
}
