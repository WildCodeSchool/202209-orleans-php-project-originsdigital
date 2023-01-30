<?php

namespace App\Form;

use App\Entity\Actuality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ActualityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la bannière'
            ])
            ->add('pictureFile', VichImageType::class, [
                'label' => 'Image de bannière',
                'required' => true,
                'allow_delete' => false,
                'download_uri' => false,
            ])
            ->add('link', UrlType::class, [
                'label' => 'Lien de la bannière',
                'required' => false,
                'help' => 'Le lien n\'est pas obligatoire'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actuality::class,
        ]);
    }
}
