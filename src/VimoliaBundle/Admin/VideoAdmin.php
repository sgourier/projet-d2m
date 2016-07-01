<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 23/06/2016
 * Time: 22:40
 */

namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VideoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text', array('label' => 'Titre', 'required' => true))
            ->add('description', 'textarea', array('label' => 'Description', 'required' => true))
            ->add('url', 'text', array('label' => 'Url', 'required' => true));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('thumbnail', 'string', array('label' => 'Thumbnail'))
            ->addIdentifier('title', 'text', array('label' => 'Titre'))
            ->addIdentifier('url', 'text', array('label' => 'Url'));
    }
}