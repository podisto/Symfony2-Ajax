<?php

namespace App\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InstitutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('adresse', 'text', array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('region', 'entity', array(
                'placeholder' => '--Selectionner une region--',
                'class'    => 'App\DemoBundle\Entity\Region',
                'property' => 'nom',
                'mapped'   => false, //Important, cet attribut n'existe pas dans notre Entité Institut
                'attr'     => array('class' => 'form-control')
            ))
            ->add('ville', 'entity', array(
                'placeholder' => '--Selectionner une ville--',
                'class'    => 'App\DemoBundle\Entity\Ville',
                'property' => 'nom',
                'attr'     => array('class' => 'form-control')
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\DemoBundle\Entity\Institut'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_demobundle_institut';
    }
}
