<?php

namespace Ctc\AppBundle\Controller\Admin\Hotel;


use Ctc\AppBundle\Controller\Admin\Common\CrudController;


use Ctc\AppBundle\Entity\Hotel\Hotel;
use Ctc\AppBundle\Form\Admin\Hotel\HotelType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Hotel\Hotel controller.
 *
 */
class HotelController extends CrudController
{


    public function __construct()
    {
        $this->repository = 'CtcAppBundle:Hotel\Hotel';
        $this->path_template = 'CtcAppBundle:Admin/Hotel/Hotel';
        $this->entity = new Hotel();
        $this->form = new HotelType();
        $this->route_prefix = 'admin_hotel';
    }




    /**
     * Lists all Hotel\Hotel entities.
     *
     */
    public function indexAction()
    {
//        $a = new Hotel();
//        $a->setImage('aa.jpg');
//        echo $a->getAbsolutePath();


        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CtcAppBundle:Hotel\Hotel')->findAll();

        return $this->render('CtcAppBundle:Admin/Hotel/Hotel:index.html.twig', array(
            'entities' => $entities,
        ));
    }



    public function listAction(Request $request)
    {

        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('c')
            ->from('CtcAppBundle:Hotel\Hotel', 'c')
            ->leftJoin('c.destination', 'dest')
            ->leftJoin('c.translations', 't');
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('t.name', 'dest.name', 'c.updated_at', ' ');
        /**
         * search
         */
        if ($request->get('sSearch')) {
            $search = strtolower($request->get('sSearch'));
            $qb
                ->orwhere("LOWER(t.name) LIKE '%" . $search . "%'");
        }
        /*
         * Ordering
         */


        for ($i = 0; $i < intval($request->get('iSortingCols')); $i++) {
            if ($request->get('bSortable_' . intval($request->get('iSortCol_' . $i))) == "true") {
                if (is_array($aColumns[($request->get('iSortCol_' . $i))])) {
                    $qb->add('orderBy', $aColumns[intval($request->get('iSortCol_' . $i))][0] . '.' . $aColumns[intval($request->get('iSortCol_' . $i))][1] . ' ' . $request->get('sSortDir_' . $i));
                } else {
                    $qb->add('orderBy', $aColumns[intval($request->get('iSortCol_' . $i))] . ' ' . $request->get('sSortDir_' . $i));
                }
            }
        }


        $query = $qb->getQuery();

        /*
        * Paging
        */
        $total = 0;
        if ($request->get('iDisplayLength') != -1) {

            $paginator = $this->get('knp_paginator');
            $page = $page = ($request->get('iDisplayStart', 0) / $request->get('iDisplayLength')) + 1;
            $pagination = $paginator->paginate($query, $page, $request->get('iDisplayLength'));

            $list = $pagination;
            $total = $pagination->getTotalItemCount();
        } else {
            $list = $query->getResult();
            $total = count($list);
        }


        /*
        * Building the json object to send to client side
        */
        $aaData = array();

        foreach ($list as $v) {
            $aaData[] = array(
                "0" => $v->getName(),
                "1" => $v->getDestination()->getName(),
                "2" =>  $v->getUpdatedAt()->format('d/m/Y'),
                "3" => $this->renderView('CtcAppBundle:Admin\Hotel\Hotel:actions_table.html.twig', array('entity' => $v)),
            );
        }

        $output = array(
            "sEcho" => intval($request->get('sEcho')),
            "iTotalRecords" => $total,
            "iTotalDisplayRecords" => $total,
            "aaData" => $aaData,
        );


//        $result = json_encode($output);



//        $response = new \Symfony\Component\HttpFoundation\Response();
//        $response->headers->set('Content-Type', 'application/json');
//        $response->setContent($result);

        $response = new JsonResponse($output);

        return $response;
    }



    /**
     * Finds and displays a Hotel\Hotel entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CtcAppBundle:Hotel\Hotel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hotel\Hotel entity.');
        }

        return $this->render('CtcAppBundle:Hotel/Hotel:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
