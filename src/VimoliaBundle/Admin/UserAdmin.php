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
use FOS\UserBundle\Model\UserManagerInterface;
# use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        # $RoleSuperAdmin = 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}';
        # $RoleExpert = 'a:2:{i:0;s:11:"ROLE_MEMBER";i:1;s:11:"ROLE_EXPERT";}';
        # $RoleMembre = 'a:1:{i:0;s:11:"ROLE_MEMBER";}';

        $formMapper
          #  ->with('Utilisateurs')
            ->add('username', 'text', array('label' => 'Pseudo', 'required' => true))
            ->add('name', 'text', array('label' => 'Nom', 'required' => true))
            ->add('firstname', 'text', array('label' => 'Prénom', 'required' => true))
            ->add('Password', 'password', array('label' => 'Password', 'required' => true))
            ->add('sex', 'choice', array(
                 'choices' => array(
                     'Homme' => 'Homme',
                     'Femme' => 'Femme')
                ))
            ->add('birthdate', 'date', array('label' => 'Date de naissance', 'required' => false))
            ->add('address', 'text', array('label' => 'Adresse', 'required' => false))
            ->add('city', 'text', array('label' => 'Ville', 'required' => true))
            ->add('zipCode', 'number', array('label' => 'Code Postal', 'required' => true))
            ->add('phone', 'number', array('label' => 'Téléphone', 'required' => false))
            ->add('cellPhone', 'number', array('label' => 'Téléphone Portable', 'required' => false))
            ->add('email', 'text', array('label' => 'Adresse Email', 'required' => true))
            ->add('discoveryType', 'choice', array(
                'choices' => array(
                    'Amis' => 'amis',
                    'Pub' => 'pub',
                    'Autre' => 'autre')
            ))
      #  ->end();

      #  if (!$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
      #      $formMapper
      #          ->with('Management')
      #          ->add('roles', 'sonata_security_roles', array(
      #              'expanded' => true,
      #              'multiple' => true,
      #              'required' => false
      #          ))
      #          ->add('locked', null, array('required' => false))
      #          ->add('expired', null, array('required' => false))
      #          ->add('enabled', null, array('required' => false))
      #          ->add('credentialsExpired', null, array('required' => false))
      #          ->end()
      #      ;
      #  }
    ;


            //->add('id', 'sonata_type_model_hidden');
           # ->add('avatarPath', 'file', array('label' => 'Avatar', 'required' => true));
           //->add('avatarPath', 'text', array('label' => 'Lien avatar', 'required' => true));
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