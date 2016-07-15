<?php

namespace VimoliaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdvancedinfosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('symptoms', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label' => 'Vos symptomes',
                'required' => true
            ))
            ->add('particularpains', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label' => 'Douleurs particulières?',
                'required' => true
            ))
            ->add('antecedents', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label' => 'Vos antécédents',
                'required' => true
            ))
            ->add('otherinformations', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label' => 'Autres informations utiles',
                'required' => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'));
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VimoliaBundle\Entity\Advancedinfos'
        ));
    }
}
