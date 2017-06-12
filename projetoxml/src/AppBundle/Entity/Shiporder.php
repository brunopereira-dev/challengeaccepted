<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="shiporder")
 */
class Shiporder
{   
    /**
    * @ORM\ManyToOne(targetEntity="Person", cascade={"all"})
    * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=FALSE)
    */
    private $person;

    /**
    * @ORM\ManyToMany(targetEntity="Item", cascade={"all"})
    */
    private $itens;
   
    public function __construct()
    {
        $this->itens = new ArrayCollection();
    }

    /**
    * @ORM\Column(type="integer")
    * @ORM\Id    
    */
    private $id;

    /**
    * @ORM\Column(type="string", length=200)
    */
    private $shiptoname;

    /**
    * @ORM\Column(type="string", length=500)
    */
    private $shiptoaddress;

    /**
    * @ORM\Column(type="string", length=100)
    */
    private $shiptocity;

    /**
    * @ORM\Column(type="string", length=50)
    */
    private $shiptocountry;

    /**
     * Set id
     *
     * @param integer $id
     * @return Shiporder
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
     * Set shiptoname
     *
     * @param string $shiptoname
     * @return Shiporder
     */
    public function setShiptoname($shiptoname)
    {
        $this->shiptoname = $shiptoname;

        return $this;
    }

    /**
     * Get shiptoname
     *
     * @return string 
     */
    public function getShiptoname()
    {
        return $this->shiptoname;
    }

    /**
     * Set shiptoaddress
     *
     * @param string $shiptoaddress
     * @return Shiporder
     */
    public function setShiptoaddress($shiptoaddress)
    {
        $this->shiptoaddress = $shiptoaddress;

        return $this;
    }

    /**
     * Get shiptoaddress
     *
     * @return string 
     */
    public function getShiptoaddress()
    {
        return $this->shiptoaddress;
    }

    /**
     * Set shiptocity
     *
     * @param string $shiptocity
     * @return Shiporder
     */
    public function setShiptocity($shiptocity)
    {
        $this->shiptocity = $shiptocity;

        return $this;
    }

    /**
     * Get shiptocity
     *
     * @return string 
     */
    public function getShiptocity()
    {
        return $this->shiptocity;
    }

    /**
     * Set shiptocountry
     *
     * @param string $shiptocountry
     * @return Shiporder
     */
    public function setShiptocountry($shiptocountry)
    {
        $this->shiptocountry = $shiptocountry;

        return $this;
    }

    /**
     * Get shiptocountry
     *
     * @return string 
     */
    public function getShiptocountry()
    {
        return $this->shiptocountry;
    }

    /**
     * Set person
     *
     * @param \AppBundle\Entity\Person $person
     * @return Shiporder
     */
    public function setPerson(\AppBundle\Entity\Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \AppBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add itens
     *
     * @param \AppBundle\Entity\Item $itens
     * @return Shiporder
     */
    public function addIten(\AppBundle\Entity\Item $itens)
    {
        $this->itens[] = $itens;

        return $this;
    }

    /**
     * Remove itens
     *
     * @param \AppBundle\Entity\Item $itens
     */
    public function removeIten(\AppBundle\Entity\Item $itens)
    {
        $this->itens->removeElement($itens);
    }

    /**
     * Get itens
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItens()
    {
        return $this->itens;
    }
}
