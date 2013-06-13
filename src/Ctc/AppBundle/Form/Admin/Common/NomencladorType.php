<?php

namespace Ctc\AppBundle\Form\Admin\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NomencladorType extends AbstractType
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
            'data_class' => 'Ctc\AppBundle\Entity\Common\Nomenclador'
        ));
    }

    public function getName()
    {
        return 'ctc_appbundle_common_nomencladortype';
    }
}
