<?php

namespace VimoliaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label' => 'Votre question',
                'required' => true
            ))
            ->add('public', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'mapped' => false,
                'label' => 'Souhaitez-vous rendre votre question publique?',
                'required' => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VimoliaBundle\Entity\Message'
        ));
    }
}
