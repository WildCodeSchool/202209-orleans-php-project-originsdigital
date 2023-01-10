<?php

namespace App\Form;

use App\Entity\Video;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
                'label' => "Description",
            ])
            ->add('duration', IntegerType::class, [
                'label' => "Durée",
            ])
            ->add('videoFileName', VichFileType::class, [
                'label' => "Vidéo",
                'required' => false,
                'allow_delete' => false,
                'constraints' => [
                    'maxSize' =>'40Mo',
                    'mimeTypes' => [
                        'mp4', 'mpeg', 'mkv', 'avi',
                    ],
                    'mimeTypesMessage' => 'Veuillez entrer un format valide parmi: MP4 / MPEG / MKV / AVI',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
