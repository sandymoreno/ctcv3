<?php

namespace Ctc\AppBundle\Form\Admin\Hotel;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('shortName')
            ->add('address')
            ->add('destination')
            ->add('location')
            ->add('category')
            ->add('description')
            ->add('interests')
            ->add('services')
            ->add('file')

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ctc\AppBundle\Entity\Hotel\Hotel'
        ));
    }

    public function getName()
    {
        return 'ctc_appbundle_hotel_hoteltype';
    }
}
