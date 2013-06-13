<?php

namespace Ctc\AppBundle\Entity\Hotel;

use Ctc\AppBundle\Entity\Common\Nomenclador;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Location
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="Ctc\AppBundle\Entity\Common\NomencladorRepository")
 */

class Location extends Nomenclador
{

}
