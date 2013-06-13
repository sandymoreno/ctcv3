<?php

namespace Ctc\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('CtcAppBundle:Admin/Dashboard:dashboard.html.twig');
    }
}
