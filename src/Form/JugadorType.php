<?php

namespace App\Form;

use App\Entity\Jugador;
use App\Entity\Equipo;//no se añade por defecto. añadir para solucionar ERROR class doesnt exists
use Symfony\Bridge\Doctrine\Form\Type\EntityType; /// no se habia añadido por defecto.añadida para solventar error 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JugadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreJugador')
            ->add('fechaNaci')
            ->add('estatura')
            ->add('posicion')
            ->add('equipo',EntityType::class,[
                'class'=>Equipo::class,
                'choice_label'=>'nombreEquipo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jugador::class,
        ]);
    }
}
