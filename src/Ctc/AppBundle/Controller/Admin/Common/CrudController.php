<?php

namespace Ctc\AppBundle\Controller\Admin\Common;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\RadBundle\Controller\Controller as RadController;

use Ctc\AppBundle\Entity\Common\Destination;
use Ctc\AppBundle\Form\Admin\Common\DestinationType;

/**
 * Common\Destination controller.
 *
 */
class CrudController extends RadController
{

    protected $repository;
    protected $path_template;
    protected $entity;
    protected $form;
    protected $route_prefix;


    /**
     * Lists all Common\Destination entities.
     *
     */
    public function indexAction()
    {

        $query = $this->getEntityManager()->getRepository($this->repository)->findAllQuery();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $this->get('request')->query->get('page', 1), 10);

        return $this->render($this->path_template.':index.html.twig', array('pagination' => $pagination, 'route_prefix'=>$this->route_prefix));
    }
    /**
     * Creates a new Common\Destination entity.
     *
     */
    public function createAction(Request $request)
    {

        $form = $this->createForm($this->form, $this->entity);
        $form->submit($request);

        if ($form->isValid()) {
            $this->persist($this->entity, true);

           return $this->redirectToRoute($this->route_prefix.'_edit', array('id' => $this->entity->getId()));

        }

        return $this->render('CtcAppBundle:Admin/Common/Destination:new.html.twig', array(
            'entity' => $this->entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Common\Destination entity.
     *
     */
    public function newAction()
    {
        $form   = $this->createForm($this->form, $this->entity);

        return $this->render($this->path_template.':new.html.twig', array(
            'entity' => $this->entity,
            'form'   => $form->createView(),
            'route_prefix' => $this->route_prefix
        ));
    }

    /**
     * Finds and displays a Common\Destination entity.
     *
     */
    public function showAction($id)
    {

        $entity = $this->findOr404($this->repository,array('id'=>$id));


        return $this->render($this->path_template.':show.html.twig', array(
            'entity'      => $entity,
            ));
    }

    /**
     * Displays a form to edit an existing Common\Destination entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->findOr404($this->repository,array('id'=>$id));


        $editForm = $this->createForm($this->form, $entity);

        return $this->render($this->path_template.':edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
                'route_prefix' => $this->route_prefix
        ));
    }

    /**
     * Edits an existing Common\Destination entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->findOr404($this->repository,array('id'=>$id));


        $editForm = $this->createForm($this->form, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->persist($entity, true);
           return $this->redirectToRoute($this->route_prefix.'_edit', array('id' => $entity->getId()));

        }

        return $this->render($this->route_prefix.':edit.html.twig', array(
            'entity'      => $this->entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Common\Destination entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $entity = $this->findOr404($this->repository,array('id'=>$id));

        $this->remove($entity, true);

        return $this->redirectToRoute('admin_destination');
    }

    /**
     * Creates a form to delete a Common\Destination entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
