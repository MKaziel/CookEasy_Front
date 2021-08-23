<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use App\Controller\ConnectionController as CC;

use function PHPSTORM_META\type;

class SocialController extends AbstractController
{
    /**
     * @Route("/social", name="Social page")
     */
    public function profil_page(CC $cc){
        if($cc->userConnected()){
            return $this->render('social/socialPage.html.twig', array());
        } else {
            return $this->redirectToRoute('User connection page');
        }
        
    }
}