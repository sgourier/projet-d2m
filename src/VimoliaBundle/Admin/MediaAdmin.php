<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 30/06/2016
 * Time: 08:38
 */

namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MediaAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', 'text', array('label' => 'Titre'))
            ->addIdentifier('thumbnail', 'thumbnail', array('label' => 'Thumbnail'));
    }

}