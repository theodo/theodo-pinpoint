<?php

namespace Theodo\NewOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewOfficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('origin', 'textarea');
        $builder->add('destination', 'textarea');
    }

    public function getName()
    {
        return 'new_office';
    }

    public function getDefaultOptions()
    {
        return array(
            'csrf_protection' => false,
        );
    }
}
