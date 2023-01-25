<?php

namespace App\DataFixtures;

use App\Entity\Actuality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActualityFixtures extends Fixture
{
    public const ACTU_IMG = [
        'Elden-ring' => 'eldenring.jpg',
        'Blop' => 'blob.jpg',
        'Xbox-game-pass' => 'xbox-game-pass-banniere.jpeg',
    ];

    public function load(ObjectManager $manager): void
    {
        $files = glob('/images/*');

        foreach ($files as $file) {
            copy($file, __DIR__ . '/../../public/uploads/images/actual/');
        }
        foreach (self::ACTU_IMG as $name => $picture) {
            $actuality = new Actuality();
            $actuality->setName($name);
            $actuality->setPicture($picture);
            $manager->persist($actuality);
        }

        $manager->flush();
    }
}
