<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Entity\Hike;

/**
 * @Route("/admin")
 */
class AdminController extends Controller {
    
    /**
     * @Route("/", name="_admin_home")
     * @Template()
     */
    public function homeAction(){
        return array();
    }
    
    /**
     * @Route("/randonnees/ajouter/", name="_admin_add_rike")
     * @Template()
     */
    public function addRikeAction(){
        $request = $this->get('request');
        $hike = new Hike();

        $form = $this->createFormBuilder($hike)
            ->add('locality', 'text')
            ->add('title', 'text', array('required' => false))
            ->add('date', 'datetime',array(
                'widget' =>'single_text',
                'format' =>'dd/MM/yyyy HH:mm'))
            ->add('distance', 'integer', array(
                'attr' => array('min' => 0),
                'data' => 0
            ))
            ->add('lenght', 'integer', array(
                'attr' => array('min' => 0),
                'data' => 0
            ))
            ->add('heightDifference', 'integer', array(
                'attr' => array('min' => 0),
                'data' => 0
            ))
            ->add('duration', 'time',array(
                'widget' =>'single_text'))
            ->add('dificulty', 'text')
            ->add('start', 'text')
            ->add('description', 'textarea')
            ->add('image1', 'file')
            ->add('image2', 'file', array('required' => false))
            ->add('image3', 'file', array('required' => false))
            ->add('save', 'submit')
            ->getForm();
        
        $form->handleRequest($request);
        
        $isSaved = false;
        if($form->isValid()) {
            $file1 = $form['image1']->getData();
            $file2 = $form['image2']->getData();
            $file3 = $form['image3']->getData();
            $nameFile1 = $file1->getClientOriginalName();
            $file1->move('uploads', $nameFile1);
            $hike->setImage1($nameFile1);
            if($file2 instanceof \Symfony\Component\HttpFoundation\File\UploadedFile){
                $nameFile2 = $file2->getClientOriginalName();
                $file2->move('uploads', $nameFile2);
                $hike->setImage2($nameFile2);
            }
            if($file3 instanceof \Symfony\Component\HttpFoundation\File\UploadedFile){
                $nameFile3 = $file3->getClientOriginalName();
                $file3->move('uploads', $nameFile3);
                $hike->setImage3($nameFile3);
            }
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($hike);
            $em->flush();
            $isSaved = true;
        }
        
        return array(
            'form' => $form->createView(),
            'isSaved' => $isSaved
        );
    }
    
    /**
     * @Route("/randonnees/editer/{id}/", name="_admin_edit_rike")
     * @Template()
     */
    public function editRikeAction($id){
        $request = $this->get('request');
        
        $hike = $this->get('doctrine')
                ->getRepository('AppBundle:Hike')
                ->find($id);

        $form = $this->createFormBuilder($hike)
            ->add('locality', 'text')
            ->add('date', 'datetime',array(
                'widget' =>'single_text',
                'format' =>'dd/MM/yyyy HH:mm'))
            ->add('distance', 'integer')
            ->add('lenght', 'integer')
            ->add('heightDifference', 'integer')
            ->add('duration', 'time',array(
                'widget' =>'single_text'))
            ->add('image','file',array(
                "label" => "Fichiers",
                "required" => FALSE,
                'mapped' => false,
                "attr" => array(
                    "accept" => "image/*",
                    "multiple" => "multiple",
                )
            ))
            ->add('save', 'submit')
            ->getForm();
        
        $formView = $form->createView();
        $formView->getChild('image')->set('full_name', 'create[image][]');
        
        if($request->getMethod() == "POST"){
            $form->handleRequest($request);
            
            
            $files = $form['image'];
            var_dump($files->getData());
           
            foreach ($files as $n) {
                $photo = $n->getData();
                var_dump($photo);
            }
            if($form->isValid() && $form->isSubmitted()) {
                /*$file = $form['image']->getData();
                $nameFile = $file->getClientOriginalName();
                $file->move('uploads', $nameFile);
                $hike->setImage($nameFile);*/


                /*$em = $this->getDoctrine()->getManager();
                $em->persist($hike);
                $em->flush();*/

            }
        }
        
        return array(
            'form' => $formView,
        );
    }
    
    /**
     * @Route("/randonnees/list/", name="_admin_list_rikes")
     * @Template()
     */
    public function listRikesAction(){
        $query = $this->get('request')->query;
        $hikes = $this->get('doctrine')
                ->getRepository('AppBundle:Hike')
                ->findAllOrdered($query->get('sort','h.id'),$query->get('direction','asc'));
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $hikes,
            $query->get('page',1),
            3
        );
        
        return array('pagination' => $pagination);
    }
    
    /**
     * @Route("/demandes/", name="_admin_requests")
     * @Template()
     */
    public function requestsAction(){
        $contactManager = $this->get('contact.manager');
        
        return array(
            'contacts' => $contactManager->getAll()
        );
    }
}
