<?php

namespace App\Form;

use App\Entity\Video;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la vidéo',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Durée',
            ])
            ->add('view', IntegerType::class, [
                'label' => 'Nombre de vues',
            ])
            ->add('picture', TextType::class, [
                'label' => 'Vignette',
            ])
            ->add('videoFile', VichFileType::class, [
                'label' => 'Vidéo',
                'required' => false,
                'delete_label' => false,
                'download_label' => false,
            ])
            ->add('public', ChoiceType::class, [
                'label' => 'Voulez-vous rendre cette vidéo accessible à tous?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'multiple' => false,
                'expanded' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
