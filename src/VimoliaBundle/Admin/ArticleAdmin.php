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
        $formMapper->add('text', 'textarea', array('label' => 'Description'));
    }
}