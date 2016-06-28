<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 23/06/2016
 * Time: 22:28
 */

namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PartnersAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text', array('label' => 'Nom', 'required' => true))
                    ->add('description', 'textarea', array('label' => 'description', 'required' => true))
                    ->add('url', 'url', array('label' => 'Lien', 'required' => true));
    }
}