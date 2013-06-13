<?php

namespace Ctc\AppBundle\Controller\Admin\Hotel;

use Ctc\AppBundle\Controller\Admin\Common\CrudController;
use Ctc\AppBundle\Entity\Hotel\HotelService;
use Ctc\AppBundle\Entity\Hotel\Location;
use Ctc\AppBundle\Form\Admin\Common\NomencladorType;
use Ctc\AppBundle\Form\Admin\Hotel\LocationType;
use Symfony\Component\HttpFoundation\Request;


/**
 * Common\Destination controller.
 *
 */
class HotelServiceController extends CrudController
{

    public function __construct()
    {
        $this->repository = 'CtcAppBundle:Hotel\HotelService';
        $this->path_template = 'CtcAppBundle:Admin/Common/Nomenclador';
        $this->entity = new HotelService();
        $this->form = new NomencladorType();
        $this->route_prefix = 'admin_hotel_service';
    }

}
