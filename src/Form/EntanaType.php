<?php

namespace App\Form;

use App\Entity\Entana;
use App\Entity\Category; //nampina
use App\Entity\Panier;//nampina
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType; //nampina
use Symfony\Component\HttpFoundation\File; //nampina
use Symfony\Component\HttpFoundation\UploadedFile; //nampina

class EntanaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre_produit')
            ->add('sary', FileType::class, [
                    //
                    'mapped'=> false,
                    //label tenenina hoe izao atao
                    'label'=>'ampidiro eto ny sary'
                    ])
            ->add('vidiny')
            ->add('description')
            ->add('category', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'category'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entana::class,
        ]);
    }
}
