<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person
{   
    /**
    * @ORM\ManyToMany(targetEntity="Phone", cascade={"all"})
    */
    private $phones;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
    }

    /**
    * @ORM\Column(type="integer")
    * @ORM\Id    
    */
    private $id;

    /**
    * @ORM\Column(type="string", length=200)
    */
    private $name;

    /**
     * Set id
     *
     * @param integer $id
     * @return Person
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add phones
     *
     * @param \AppBundle\Entity\Phone $phones
     * @return Person
     */
    public function addPhone(\AppBundle\Entity\Phone $phones)
    {        
        $this->phones[] = $phones;                
        return $this;
    }
    
    /**
     * Remove phones
     *
     * @param \AppBundle\Entity\Phone $phones
     */
    public function removePhone(\AppBundle\Entity\Phone $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones()
    {
        return $this->phones;
    }    
}
