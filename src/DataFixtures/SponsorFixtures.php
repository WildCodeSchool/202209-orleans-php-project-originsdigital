<?php

namespace App\DataFixtures;

use App\Entity\Sponsor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SponsorFixtures extends Fixture
{
    public const NB_SPONSOR = 4;

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::NB_SPONSOR; $i++) {
            $sponsor = new Sponsor();
            $sponsor->setName('sponsor' . $i);
            $sponsor->setLogo('placeHolder.png');
            $sponsor->setLink('http://redbull.com');
            $manager->persist($sponsor);
        }
        $manager->flush();
    }
}
