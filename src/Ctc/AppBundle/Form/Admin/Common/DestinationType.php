<?php

namespace Ctc\AppBundle\Form\Admin\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
//            ->add('lft')
//            ->add('lvl')
//            ->add('rgt')
//            ->add('root')
            ->add('parent')
            ->add('type','choice', array('choices'=>array('provincia'=>'Provincia','ciudad'=>'Ciudad')))
            ->add('translations', 'a2lix_translations')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ctc\AppBundle\Entity\Common\Destination'
        ));
    }

    public function getName()
    {
        return 'ctc_appbundle_common_destinationtype';
    }
}
