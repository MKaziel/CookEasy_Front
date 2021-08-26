<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

use function PHPSTORM_META\type;
use App\Controller\ConnectionController as CC;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="Default Accueil")
     */
    public function default_accueil(CC $cc){
        if($cc->userConnected()){
            return $this->render('page_accueil/accueil.html.twig', array());
        } else {
            return $this->redirectToRoute('User connection page');
        }
        
    }

    /**
     * @Route("/accueil", name="Accueil")
     */
    public function accueil(CC $cc){
        if($cc->userConnected()){
            return $this->render('page_accueil/accueil.html.twig', array());
        } else {
            return $this->redirectToRoute('User connection page');
        }
        
    }
}