<?php

namespace App\DataFixtures;

use App\Entity\Advertisement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdFixtures extends Fixture
{
    public const ADS_IMG = 'https://jeuxvideo.rds.ca/wp-content/uploads/sites/2/2020/06/LOL_PROMOART_4.jpg';
    /* public const ADS_IMG = [
        'Among-us' => '',
        'Horizon-zero-dawn' => '',
        'Rocket-league' => '',
        'Ps5' => '',
        'Warcraft' => ''
    ]; */

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $advert = new Advertisement();
            $advert->setName('LOL');
            $advert->setPoster(self::ADS_IMG);
            $advert->setLinkTo('https://www.leagueoflegends.com/fr-fr/');
            $manager->persist($advert);
        }

        $manager->flush();
    }
}
