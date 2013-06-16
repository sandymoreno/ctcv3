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
//            ->add('name')
//            ->add('shortName')
            ->add('address')
            ->add('destination')
            ->add('location')
            ->add('category')
//            ->add('description')
            ->add('interests')
            ->add('services')
            ->add('file')
            ->add('translations', 'a2lix_translations', array(
                    'fields' => array(                      // [3]
                        'slug' => array(                   // [3.a]
                            'locale_options' => array(            // [3.b]
                                'es' => array(
                                    'display' => false             // [4]
                                ),
                                'en' => array(
                                    'display' => false                  // [4]
                                )
                            )
                        )
                    )
                ))

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
