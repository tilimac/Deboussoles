<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hike
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HikeRepository")
 */
class Hike {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="locality", type="string", length=255)
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image1", type="string", length=255)
     */
    public $image1;

    /**
     * @var string
     *
     * @ORM\Column(name="image2", type="string", length=255, nullable=true)
     */
    public $image2;

    /**
     * @var string
     *
     * @ORM\Column(name="image3", type="string", length=255, nullable=true)
     */
    public $image3;

    /**
     * @var integer
     *
     * @ORM\Column(name="distance", type="integer")
     */
    private $distance;

    /**
     * @var integer
     *
     * @ORM\Column(name="lenght", type="integer")
     */
    private $lenght;

    /**
     * @var integer
     *
     * @ORM\Column(name="heightDifference", type="integer")
     */
    private $heightDifference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duration", type="time")
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="dificulty", type="string", length=255)
     */
    private $dificulty;

    /**
     * @var string
     *
     * @ORM\Column(name="start", type="string", length=255)
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="canceled", type="boolean", options={"default":false})
     */
    private $canceled = false;
    
    public function __construct() {
        //$this->image = array();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Hike
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set locality
     *
     * @param string $locality
     * @return Hike
     */
    public function setLocality($locality) {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return string 
     */
    public function getLocality() {
        return $this->locality;
    }

    /**
     * Set image1
     *
     * @param string $image1
     * @return Hike
     */
    public function setImage1($image1) {
        $this->image1 = $image1;

        return $this;
    }

    /**
     * Get image1
     *
     * @return string 
     */
    public function getImage1() {
        return $this->image1;
    }

    /**
     * Set image2
     *
     * @param string $image2
     * @return Hike
     */
    public function setImage2($image2) {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return string 
     */
    public function getImage2() {
        return $this->image2;
    }

    /**
     * Set image3
     *
     * @param string $image3
     * @return Hike
     */
    public function setImage3($image3) {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * Get image3
     *
     * @return string 
     */
    public function getImage3() {
        return $this->image3;
    }

    /**
     * Set distance
     *
     * @param integer $distance
     * @return Hike
     */
    public function setDistance($distance) {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return integer 
     */
    public function getDistance() {
        return $this->distance;
    }

    /**
     * Set lenght
     *
     * @param integer $lenght
     * @return Hike
     */
    public function setLenght($lenght) {
        $this->lenght = $lenght;

        return $this;
    }

    /**
     * Get lenght
     *
     * @return integer 
     */
    public function getLenght() {
        return $this->lenght;
    }

    /**
     * Set heightDifference
     *
     * @param integer $heightDifference
     * @return Hike
     */
    public function setHeightDifference($heightDifference) {
        $this->heightDifference = $heightDifference;

        return $this;
    }

    /**
     * Get heightDifference
     *
     * @return integer 
     */
    public function getHeightDifference() {
        return $this->heightDifference;
    }

    /**
     * Set duration
     *
     * @param \DateTime $duration
     * @return Hike
     */
    public function setDuration($duration) {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \DateTime 
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * Set canceled
     *
     * @param boolean $canceled
     * @return Hike
     */
    public function setCanceled($canceled) {
        $this->canceled = $canceled;

        return $this;
    }

    /**
     * Get canceled
     *
     * @return boolean 
     */
    public function getCanceled() {
        return $this->canceled;
    }


    /**
     * Set title
     *
     * @param string $title
     * @return Hike
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set dificulty
     *
     * @param string $dificulty
     * @return Hike
     */
    public function setDificulty($dificulty)
    {
        $this->dificulty = $dificulty;

        return $this;
    }

    /**
     * Get dificulty
     *
     * @return string 
     */
    public function getDificulty()
    {
        return $this->dificulty;
    }

    /**
     * Set start
     *
     * @param string $start
     * @return Hike
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Hike
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
