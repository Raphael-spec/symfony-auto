<?php

namespace App\Form;

use App\Entity\Auto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('pays', TextType::class, ['attr'=>['placeholder'=>'Veuillez entrer le pays']])
            ->add('prix', NumberType::class, ['attr'=>['placeholder'=>'Veuillez entrer le prix']])
            ->add('description', TextareaType::class, ['attr'=>['placeholder'=>'Veuillez entre la description']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)//les parametres par defaut
    {
        $resolver->setDefaults([
            'data_class' => Auto::class,
        ]);
    }
}
