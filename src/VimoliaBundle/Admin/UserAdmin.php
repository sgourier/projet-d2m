<?php

/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 10/06/2016
 * Time: 18:33
 */
namespace VimoliaBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper->add('username', 'text', array('label' => 'Pseudo', 'required' => true))
            ->add('name', 'text', array('label' => 'Nom', 'required' => true))
            ->add('firstname', 'text', array('label' => 'Prénom', 'required' => true))
            ->add('sex', 'choice', array(
                 'choices' => array(
                     'Male' => 'm',
                     'Female' => 'f')
                ))
            ->add('birthdate', 'date', array('label' => 'Date de naissance', 'required' => false))
            ->add('address', 'text', array('label' => 'Adresse', 'required' => false))
            ->add('city', 'text', array('label' => 'Ville', 'required' => true))
            ->add('zipCode', 'number', array('label' => 'Code Postal', 'required' => true))
            ->add('phone', 'number', array('label' => 'Téléphone', 'required' => false))
            ->add('cellPhone', 'number', array('label' => 'Téléphone Portable', 'required' => false))
            ->add('discoveryType', 'choice', array(
                'choices' => array(
                    'Amis' => 'amis',
                    'Pub' => 'pub',
                    'Autre' => 'autre')
            ))
         #   ->add('avatarpath', 'sonata_type_model', $avatarpath)
            ->add('id', 'sonata_type_model_hidden');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')
            ->add('username')
            ->add('firstname');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('username', 'text', array('label' => 'Pseudo'))
            ->addIdentifier('name', 'text', array('label' => 'Nom'))
            ->addIdentifier('firstname', 'text', array('label' => 'Prénom'))
            ->addIdentifier('sex', 'text', array('label' => 'Sexe'))
            ->addIdentifier('birthdate', 'date', array('label' => 'Date de naissance'))
            ->addIdentifier('address', 'text', array('label' => 'Adresse'))
            ->addIdentifier('city', 'text', array('label' => 'Ville'))
            ->addIdentifier('zipCode', 'number', array('label' => 'Code postal'))
            ->addIdentifier('phone', 'number', array('label' => 'Téléphone'));
    }
}