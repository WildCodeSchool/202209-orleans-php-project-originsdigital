<?php

namespace App\DataFixtures;

use App\Entity\Advertisement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Persistence\ObjectManager;

class AdFixtures extends Fixture
{
    public const ADS_IMG = [
        'Among-us' => 'amongus.png',
        'Horizon-zero-dawn' => 'horizon.png',
        'Rocket-league' => 'rocket.png',
        'Ps5' => 'ps5.png',
        'Warcraft' => 'warcraft.png'
    ];

    public function __construct(private Filesystem $filesystem)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->filesystem->remove(__DIR__ . '/../../public/uploads/images/');
        $this->filesystem->mkdir(__DIR__ . '/../../public/uploads/images/');

        foreach (self::ADS_IMG as $title => $pics) {
            $advert = new Advertisement();
            $advert->setName($title);
            copy('./src/DataFixtures/images/' . $pics, __DIR__ . '/../../public/uploads/images/' . $pics);
            $advert->setPoster($pics);
            $advert->setLinkTo('https://www.leagueoflegends.com/fr-fr/');
            $manager->persist($advert);
        }

        $manager->flush();
    }
}
