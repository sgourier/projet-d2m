<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PractInfosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siret','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.siret'
            ))
            ->add('proaddress','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.proAddress'
            ))
            ->add('proaddressplus','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.proAddressPlus'
            ))
            ->add('procity','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.proCity'
            ))
            ->add('prozipcode','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.proZipCode'
            ))
            ->add('prophone','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.proPhone'
            ))
            ->add('procellphone','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.proCellPhone'
            ))
            ->add('url','Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label' => 'practInfos.proUrl'
            ))
            ->add('description','Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label' => 'practInfos.description'
            ))
            ->add('degrees','Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label' => 'practInfos.degrees'
            ))
            ->add('idPractdomains','Symfony\Bridge\Doctrine\Form\Type\EntityType',array(
                'label' => 'practInfos.practDomains',
                'class' => 'VimoliaBundle\Entity\Practdomains',
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\PractInfos'
        ));
    }
}
