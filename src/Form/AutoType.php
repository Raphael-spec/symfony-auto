<?php

namespace App\Form;

use App\Entity\Auto;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('categorie', EntityType::class, ['label'=>'Categorie', 'class'=>Categorie::class,'choice_label'=>'nom', 'attr'=>['class'=>'form-select']])
            ->add('image', FileType::class,['label'=>'image','attr'=>['class'=>'form-control']] )
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
