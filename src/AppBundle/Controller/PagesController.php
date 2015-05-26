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
        return array();
    }
    
    /**
     * @Route("/previousHikes", name="_previous_hikes")
     * @Template()
     */
    public function previousHikesAction(){
        return array();
    }
}
