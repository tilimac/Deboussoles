<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PagesController extends Controller {
    /**
     * @Route("/", name="_home")
     * @Template()
     */
    public function homeAction(){
        $hikeManager = $this->get('hike.manager');
        
        return array(
            'nextHike' => $hikeManager->getNextHike(),
            'previousHikes' => $hikeManager->getPreviousHikes(6)
        );
    }
    
    /**
     * @Route("/randonnees/precedentes/", name="_previous_hikes")
     * @Template()
     */
    public function previousHikesAction(){
        $hikeManager = $this->get('hike.manager');
        
        return array(
            'previousHikes' => $hikeManager->getPreviousHikes()
        );
    }
    
    /**
     * @Route("/randonnees/prochaines/", name="_next_hikes")
     * @Template()
     */
    public function nextHikesAction(){
        return array();
    }
    
    /**
     * @Route("/randonnee/{id}/", name="_hike")
     * @Template()
     */
    public function hikeAction($id){
        $hikeManager = $this->get('hike.manager');
        
        return array(
            'hike' => $hikeManager->getHike($id)
        );
    }
    
    /**
     * @Route("/contact", name="_contact")
     * @Template()
     */
    public function contactAction(){
        return array();
    }
}
