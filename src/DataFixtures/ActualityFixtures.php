<?php

namespace App\DataFixtures;

use App\Entity\Actuality;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Filesystem\Filesystem;

class ActualityFixtures extends Fixture
{
    public const ACTU_IMG = [
        'Elden-ring' => 'eldenring.jpg',
        'Blop' => 'blob.jpg',
        'Xbox-game-pass' => 'xbox-game-pass-banniere.jpeg',
    ];

    public function __construct(private Filesystem $filesystem)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->filesystem->remove(__DIR__ . '/../../public/uploads/images/actualities/');
        $this->filesystem->mkdir(__DIR__ . '/../../public/uploads/images/actualities/');

        foreach (self::ACTU_IMG as $name => $picture) {
            $actuality = new Actuality();
            $actuality->setName($name);
            copy(
                './src/DataFixtures/images/actualities/' . $picture,
                __DIR__ . '/../../public/uploads/images/actualities/' . $picture
            );
            $actuality->setPicture($picture);
            $manager->persist($actuality);
        }

        $manager->flush();
    }
}
