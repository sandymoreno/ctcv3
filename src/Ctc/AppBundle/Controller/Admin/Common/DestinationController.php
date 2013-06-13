<?php

namespace Ctc\AppBundle\Controller\Admin\Common;

use Ctc\AppBundle\Entity\Common\Destination;
use Ctc\AppBundle\Form\Admin\Common\DestinationType;
use Symfony\Component\HttpFoundation\Request;


/**
 * Common\Destination controller.
 *
 */
class DestinationController extends CrudController
{

    public function __construct()
    {
        $this->repository = 'CtcAppBundle:Common\Destination';
        $this->path_template = 'CtcAppBundle:Admin/Common/Destination';
        $this->entity = new Destination();
        $this->form = new DestinationType();
        $this->route_prefix = 'admin_destination';
    }

}
