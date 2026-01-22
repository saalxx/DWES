<?php

namespace App\Form;

use App\Entity\Player;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
            'label' => 'Nombre',
                ])
            ->add('lastName' ,null , [
                'label' => 'Apellido',
            ])
            ->add('age' , null, [
                'label' => 'Edad',
                'attr' => [
                    'min' => 0,
                    'max' => 120,
                    'step' => 1,
                ],
            ])
            ->add('team' , null, [
                'label' => 'Equipo',
                'choices' => [
                    'Real Madrid' => 'real_madrid',
                    'Barcelona'   => 'barcelona',
                    'Atlético'    => 'atletico',
                    'Valencia'    => 'valencia',
                ],
                'placeholder' => 'Selecciona un equipo',
                'required' => true,])
            ->add('goals' , null, [
                'label' => 'Goles',])
            ->add('cards' , null, [
                'label' => 'Cargos',
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Fecha de nacimiento',
                'widget' => 'single_text',
                'required' => false,
                'help' => 'Selecciona tu fecha de nacimiento',
            ]);
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
