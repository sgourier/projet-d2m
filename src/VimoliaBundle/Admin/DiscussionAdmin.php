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

class DiscussionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('public', 'choice', array(
                   'choices' => array(
                      'Public' => 'true',
                      'Privé' => 'false')
                   ))
                   ->add('feedback', 'text', array('label' => 'Retour', 'required' => true))
                    ->add('dateadd', 'datetime', array('label' => 'Date ADD'))
                    ->add('dateupd', 'datetime', array('label' => 'Date UPD'))
                   ->add('active', 'choice', array(
                       'choices' => array(
                           'Active' => 'true',
                           'Non-active' => 'false')
                   ), array('label' => 'Active', 'required' => true))
                    ->add('closed', 'choice', array(
                        'choices' => array(
                            'Fermé' => 'true',
                            'Ouverte' => 'false')
                    ), array('label' => 'Etat', 'required' => true))
                    ->add('status', 'text', array('label' => 'Status', 'required' => true))
                    ->add('id', 'sonata_type_model_hidden')
                    ->add('idPract', 'sonata_type_model_hidden')
                    ->add('idMember', 'sonata_type_model_hidden')
                    ->add('idExpert', 'sonata_type_model_hidden')
                    ->add('question', 'sonata_type_model_hidden')
                    ->add('reponse', 'sonata_type_model_hidden')
                    ->add('id_advancedInfos', 'sonata_type_model_hidden');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('feedback', 'text', array('label' => 'Retour'));
    }
}