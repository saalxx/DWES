<?php

namespace App\Form;

use App\Entity\Students;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('age')
            ->add('studentNumber')
            ->add('course')
            ->add('gradeAverage', NumberType::class, [
                'required' => true,
                'scale' => 2,
            ])
            ->add('enrollmentDate', null, [
                'widget' => 'single_text',
            ])
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Students::class,
        ]);
    }
}
