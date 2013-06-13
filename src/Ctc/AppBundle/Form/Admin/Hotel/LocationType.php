<?php

namespace Ctc\AppBundle\Form\Admin\Hotel;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ctc\AppBundle\Entity\Hotel\Location'
        ));
    }

    public function getName()
    {
        return 'ctc_appbundle_hotel_locationtype';
    }
}
