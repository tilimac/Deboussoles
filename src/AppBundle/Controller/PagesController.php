<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Contact;

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
     * @Route("/association/", name="_association")
     * @Template()
     */
    public function associationAction(){
        return array();
    }
    
    /**
     * @Route("/contact/", name="_contact")
     * @Template()
     */
    public function contactAction(){
        $contact = new Contact();
        $request = $this->get('request');
        
        $formBuilder = $this->get('form.factory')->createBuilder('form', $contact);

        $formBuilder
          ->add('firstName', 'text')
          ->add('lastName', 'text')
          ->add('phoneNumber', 'text')
          ->add('mail', 'text')
          ->add('message', 'textarea')
          ->add('save', 'submit', array('label' => 'Envoyer'));
        $form = $formBuilder->getForm();
        
        $formEmpty = $form;
        
        $form->handleRequest($request);
        
        $success = NULL;
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $contact->setDate(new \DateTime());
            $em->persist($contact);
            $em->flush();
            
            $success = true;
        }
        
        return array(
            'form' => $form->createView(),
            'success' => $success
        );
    }
    
    /**
     * @Route("/calendrier/", name="_calendar")
     * @Template()
     */
    public function calendarAction(){
        $hikeManager = $this->get('hike.manager');
        $months = array(NULL, 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        $days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
        $numDay = array(NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
        
        
        $now = new \DateTime();
        $nbDayByMonth = array();
        $firstDayByMonth = array();
        $count = 0;
        $currentYear = intval($now->format('Y'));
        $nextYear = $currentYear+1;
        for ($i = 0; $i < 12; $i++) {
            $month = $now->format('n');
            $year = $now->format('Y');
            $nbDayByMonth[$month] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $firstDayByMonth[$month] = date("w", mktime(0, 0, 0, $month, 1, date("Y") ));
            $now->add(new \DateInterval('P1M'));
            if($month == 1) $nbMonthCurrentYear = $count;
            $count++;
        }
        
        if($nbMonthCurrentYear == 0) $nbMonthCurrentYear=12;
        $nbMonthnextYear = 12-$nbMonthCurrentYear;
        
        $calendar = array();
        for ($i = 1; $i <= 37; $i++) {
            $day = $i%7;
            $calendarLine = array();
            foreach ($nbDayByMonth as $month => $number) {
                if(($firstDayByMonth[$month] == $day || $numDay[$month] > 1) && $nbDayByMonth[$month] >= $numDay[$month]){
                    $calendarLine[$month] = $numDay[$month];
                    $numDay[$month]++;
                }
                else{
                    $calendarLine[$month] = NULL;
                }
            }
            $calendar[] = $calendarLine;
        }
        
        $programme = array();
        foreach ($hikeManager->getAll() as $hike) {
            $month = $hike->getDate()->format('n');
            $day = $hike->getDate()->format('j');
            $programme[$month][$day] = $hike;
        }
        
        return array(
            'months' => $months,
            'days' => $days,
            'calendar' => $calendar,
            'nbDayByMonth' => $nbDayByMonth,
            'programme' => $programme,
            'currentYear' => $currentYear,
            'nextYear' => $nextYear,
            'nbMonthCurrentYear' => $nbMonthCurrentYear,
            'nbMonthnextYear' => $nbMonthnextYear
        );
    }
}
