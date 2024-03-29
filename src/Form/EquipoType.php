<?php

namespace App\Form;

use App\Entity\Equipo;
use App\Entity\Zona;//no se añade por defecto. añadir para solucionar ERROR class doesnt exists 
use Symfony\Bridge\Doctrine\Form\Type\EntityType; /// no se habia añadido por defecto.añadida para solventar error 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreEquipo')
            ->add('presupuesto')
            ->add('fechaFunda')
            ->add('zona', EntityType::class, [
               'class' => Zona::class,
               'choice_label' => 'nombreZona',

            ])
 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipo::class,
        ]);
    }
}
