<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 23/06/2016
 * Time: 22:15
 */

namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SubscribeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text', array('label' => 'Nom', 'required' => true))
        ->add('price', 'number', array('label' => 'Prix (en €)', 'required' => true))
        ->add('time', 'number', array('label' => 'Durée (Mois)', 'required' => true))
        ->add('description', 'textarea', array('label' => 'Description', 'required' => true))
        ->add('active', 'choice', array(
        'choices' => array(
            'activé' => 'true',
            'désactivé' => 'false')
         ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')
            ->add('price')
            ->add('time');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', 'text', array('label' => 'Nom'))
        ->addIdentifier('price', 'number', array('label' => 'Prix (en €)'))
        ->addIdentifier('time', 'number', array('label' => 'Durée (Mois)'))
        ->addIdentifier('description', 'textarea', array('label' => 'Description'))
        ->addIdentifier('active', 'boolean', array('label' => 'active'));
    }
}