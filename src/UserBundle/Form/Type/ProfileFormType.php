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

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plainPassword', 'Symfony\Component\Form\Extension\Core\Type\RepeatedType', array(
			        'type' => 'Symfony\Component\Form\Extension\Core\Type\PasswordType',
			        'options' => array('translation_domain' => 'FOSUserBundle'),
			        'first_options' => array('label' => 'form.new_password'),
			        'second_options' => array('label' => 'form.new_password_confirmation'),
			        'invalid_message' => 'fos_user.password.mismatch',
			        'required' => false
		        ))
		        ->add('name','Symfony\Component\Form\Extension\Core\Type\TextType',array(
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
                ->add('avatarPath','Symfony\Component\Form\Extension\Core\Type\FileType',array(
                    'label' => 'form.avatar',
                    'translation_domain' => 'FOSUserBundle',
                    'required' => false
                ))
                ->add('keepImg','Symfony\Component\Form\Extension\Core\Type\HiddenType',array(
                    'required' => true,
                    'empty_data' => 1,
                    'mapped' => false
                ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}
