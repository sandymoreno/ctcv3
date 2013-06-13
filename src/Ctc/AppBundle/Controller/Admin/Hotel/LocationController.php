<?php

namespace Ctc\AppBundle\Controller\Admin\Hotel;

use Ctc\AppBundle\Controller\Admin\Common\CrudController;
use Ctc\AppBundle\Entity\Hotel\Location;
use Ctc\AppBundle\Form\Admin\Hotel\LocationType;
use Symfony\Component\HttpFoundation\Request;


/**
 * Common\Destination controller.
 *
 */
class LocationController extends CrudController
{

    public function __construct()
    {
        $this->repository = 'CtcAppBundle:Hotel\Location';
        $this->path_template = 'CtcAppBundle:Admin/Common/Nomenclador';
        $this->entity = new Location();
        $this->form = new LocationType();
        $this->route_prefix = 'admin_location';
    }

}
