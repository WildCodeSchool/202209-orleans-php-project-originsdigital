<?php

namespace App\DataFixtures;

use App\Entity\Advertisement;
use Doctrine\Bundle\FixturesBundle\Fixture;
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

    public function load(ObjectManager $manager): void
    {
        foreach (self::ADS_IMG as $title => $pics) {
            $advert = new Advertisement();
            $advert->setName($title);
            $advert->setPoster($pics);
            $advert->setLinkTo('https://www.leagueoflegends.com/fr-fr/');
            $manager->persist($advert);
        }

        $manager->flush();
    }
}
