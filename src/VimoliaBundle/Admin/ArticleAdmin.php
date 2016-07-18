<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 23/06/2016
 * Time: 22:43
 */

namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text', array('label' => 'Titre'))
            ->add('text', 'textarea', array('label' => 'Description'))
            ->add('active', 'checkbox', array('label' => 'Active', 'required' => false))
            ->add('dateupd', 'sonata_type_model_hidden')
            ->add('id', 'sonata_type_model_hidden');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('dateupd');
        $datagridMapper->add('dateadd');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', 'text', array('label' => 'Title'))
            ->addIdentifier('text', 'textarea', array('label' => 'Description'));
    }
}