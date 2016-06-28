<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 23/06/2016
 * Time: 22:00
 */

namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CguAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('text', 'textarea', array('label' => 'Description', 'required' => true));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('text', array('label' => 'Description', 'required' => true));
    }
}