<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 23/06/2016
 * Time: 22:37
 */

namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CertificationsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text', array('label' => 'Nom', 'required' => true))
            ->add('description', 'textarea', array('label' => 'Description', 'required' => true))
            ->add('url', 'url', array('label' => 'Lien internet', 'required' => true), array('placeholder' => 'http://'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', 'text', array('label' => 'Nom'))
            ->addIdentifier('description', 'textarea', array('label' => 'Description'))
            ->addIdentifier('url', 'url', array('label' => 'url'));
    }
}