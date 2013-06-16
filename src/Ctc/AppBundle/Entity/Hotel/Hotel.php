<?php

namespace Ctc\AppBundle\Entity\Hotel;

use Ctc\AppBundle\Entity\Common\Interest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Hotel
 *
 * @ORM\Table
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ctc\AppBundle\Entity\Hotel\HotelRepository")
 */
class Hotel
{


    use ORMBehaviors\Timestampable\Timestampable;
    use ORMBehaviors\Blameable\Blameable;
    use ORMBehaviors\Translatable\Translatable;


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
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Ctc\AppBundle\Entity\Common\Destination")
     * @ORM\JoinColumn(name="destination_id", referencedColumnName="id")
     *
     */
    private $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="smallint")
     */
    private $category;


    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var
     * @Assert\Image()
     */
    public $file;



    /**
     * @ORM\ManyToMany(targetEntity="Ctc\AppBundle\Entity\Common\Interest" )
     */
    private $interests;

    /**
     * @ORM\ManyToMany(targetEntity="HotelService" )
     */
    private $services;




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
     * Set address
     *
     * @param string $address
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return Hotel
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    
        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Hotel
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set category
     *
     * @param integer $category
     * @return Hotel
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * Set image
     *
     * @param string $image
     * @return Hotel
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }




    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir()
    {
// the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/hotels';
    }





    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->image = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->image);
        unset($this->file);

    }


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }






    /**
     * Constructor
     */
    public function __construct()
    {
        $this->interests = new ArrayCollection();
        $this->services = new ArrayCollection();
    }
    
    /**
     * Add interests
     *
     * @param \Ctc\AppBundle\Entity\Common\Interest $interests
     * @return Hotel
     */
    public function addInterest(Interest $interests)
    {
        $this->interests[] = $interests;
    
        return $this;
    }

    /**
     * Remove interests
     *
     * @param \Ctc\AppBundle\Entity\Common\Interest $interests
     */
    public function removeInterest(Interest $interests)
    {
        $this->interests->removeElement($interests);
    }

    /**
     * Get interests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Add services
     *
     * @param \Ctc\AppBundle\Entity\Hotel\HotelService $services
     * @return Hotel
     */
    public function addService(HotelService $services)
    {
        $this->services[] = $services;
    
        return $this;
    }

    /**
     * Remove services
     *
     * @param \Ctc\AppBundle\Entity\Hotel\HotelService $services
     */
    public function removeService(HotelService $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
    }


    public function __call($methodOrProperty, $arguments)
    {
        if (!method_exists(self::getTranslationEntityClass(), $methodOrProperty)) {
            $methodOrProperty = 'get'. ucfirst($methodOrProperty);
        }

        return $this->proxyCurrentLocaleTranslation($methodOrProperty, $arguments);
    }

}