<?php
namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Description of HikeManager
 *
 * @author Valentin
 */
class HikeManager {
    
    protected $em;
    protected $repository;
    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $this->em->getRepository('AppBundle:Hike');
    }
    
    public function getAll() {
        return $this->repository->findAll();
    }
    
    public function getHike($id) {
        return $this->repository->find($id);
    }
    
    public function getNextHike() {
        return $this->repository->findNextHike();
    }
    
    public function getPreviousHikes($limit = null) {
        return $this->repository->findPreviousHikes($limit);
    }
}
