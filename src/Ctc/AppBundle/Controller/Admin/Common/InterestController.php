<?php

namespace Ctc\AppBundle\Controller\Admin\Common;

use Ctc\AppBundle\Controller\Admin\Common\CrudController;
use Ctc\AppBundle\Entity\Common\Interest;
use Ctc\AppBundle\Entity\Hotel\Location;
use Ctc\AppBundle\Form\Admin\Common\NomencladorType;
use Ctc\AppBundle\Form\Admin\Hotel\LocationType;
use Symfony\Component\HttpFoundation\Request;


/**
 * Common\Destination controller.
 *
 */
class InterestController extends CrudController
{

    public function __construct()
    {
        $this->repository = 'CtcAppBundle:Common\Interest';
        $this->path_template = 'CtcAppBundle:Admin/Common/Nomenclador';
        $this->entity = new Interest();
        $this->form = new NomencladorType();
        $this->route_prefix = 'admin_interest';
    }

}
