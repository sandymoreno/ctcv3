<?php

namespace Ctc\AppBundle\Entity\Hotel;

use Ctc\AppBundle\Entity\Common\Nomenclador;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 *
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="Ctc\AppBundle\Entity\Common\NomencladorRepository")
 */

class HotelService extends Nomenclador
{

}
