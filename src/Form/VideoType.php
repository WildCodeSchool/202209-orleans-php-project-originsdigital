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
            ->add('videoFile', VichFileType::class, [
                'label' => 'Vidéo',
                'required' => false,
                'delete_label' => false,
                'download_label' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2m',
                        'mimeTypes' => [
                            'video/flv',
                            'video/mp4',
                            'video/mkv',
                        ],
                        'mimeTypesMessage' => 'Veuillez utiliser une vidéo au format: MP4 / FLV / MKV',
                    ])
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
