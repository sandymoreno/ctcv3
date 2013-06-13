<?php

namespace Ctc\AppBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Nomenclador
 *
 * @ORM\Table(name="nomenclador")
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap(
 * {
 * "location" = "Ctc\AppBundle\Entity\Hotel\Location",
 * "hotelservice" = "Ctc\AppBundle\Entity\Hotel\HotelService",
 * "interest" = "Ctc\AppBundle\Entity\Common\Interest",
 * }
 * )
 *
 */
abstract class Nomenclador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


//    /**
//     * @Gedmo\Locale
//     * Used locale to override Translation listener`s locale
//     * this is not a mapped field of entity metadata, just a simple property
//     */
//    private $locale;
//
//
//
//    public function setTranslatableLocale($locale)
//    {
//        $this->locale = $locale;
//    }



    public function __toString(){
        return $this->getName();
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
     * @return Nomenclador
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
     * Set code
     *
     * @param string $code
     * @return Nomenclador
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Nomenclador
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
