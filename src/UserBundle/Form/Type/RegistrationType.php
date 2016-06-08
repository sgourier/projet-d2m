<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','Symfony\Component\Form\Extension\Core\Type\TextType',array(
            'label' => 'form.name',
            'translation_domain' => 'FOSUserBundle',
            'required' => true
            ))
            ->add('firstname','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'form.firstname',
                'translation_domain' => 'FOSUserBundle',
                'required' => true
            ))
            ->add('birthdate','Symfony\Component\Form\Extension\Core\Type\BirthdayType',array(
                'label' => 'form.birthdate',
                'translation_domain' => 'FOSUserBundle',
                'required' => true,
                'attr' => array(
                    'class' => 'datepicker'
                )
            ))
            ->add('address','Symfony\Component\Form\Extension\Core\Type\TextType',array(
            'label' => 'form.address',
            'translation_domain' => 'FOSUserBundle',
            'required' => true
            ))
            ->add('addressPlus','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'form.addressPlus',
                'translation_domain' => 'FOSUserBundle',
                'required' => false
            ))
            ->add('zipCode','Symfony\Component\Form\Extension\Core\Type\IntegerType',array(
                'label' => 'form.zipCode',
                'translation_domain' => 'FOSUserBundle',
                'required' => true
            ))
            ->add('city','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'form.city',
                'translation_domain' => 'FOSUserBundle',
                'required' => true
            ))
            ->add('phone','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'form.phone',
                'translation_domain' => 'FOSUserBundle',
                'required' => false
            ))
            ->add('cellPhone','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'form.cellPhone',
                'translation_domain' => 'FOSUserBundle',
                'required' => false
            ))
            ->add('discoveryType','Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label' => 'form.discoveryType',
                'translation_domain' => 'FOSUserBundle',
                'choices' => array(
                    "registration.discovery.friends" => 0,
                    "registration.discovery.advert" => 1,
                    "registration.discovery.other" => 2
                )
            ))
            ->add('roles','Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'translation_domain' => 'FOSUserBundle',
                'choices' => array(
                    "registration.role.user" => "ROLE_MEMBER",
                    "registration.role.pract" => "ROLE_PRACTITIONER"
                ),
                'label' => false,
                'expanded' => false,
                'multiple' => true,
                'mapped' => false,
                'attr' => array(
                    'class' => 'hidden'
                )
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
