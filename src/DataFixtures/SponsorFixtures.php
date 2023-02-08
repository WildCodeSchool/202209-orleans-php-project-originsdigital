<?php

namespace App\DataFixtures;

use App\Entity\Sponsor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

class SponsorFixtures extends Fixture
{
    public function __construct(private FileSystem $filesystem)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->filesystem->remove(__DIR__ . '/../../public/uploads/images/logos/');
        $this->filesystem->mkdir(__DIR__ . '/../../public/uploads/images/logos/');

        $sponsor = new Sponsor();
        $picAtos = 'Atos_logo.png';
        $sponsor->setName('Atos');
        copy(
            './src/DataFixtures/images/logos/' . $picAtos,
            __DIR__ . '/../../public/uploads/images/logos/' . $picAtos
        );
        $sponsor->setLogo($picAtos);
        $sponsor->setLink('https://www.atos.net/');
        $manager->persist($sponsor);

        $sponsor = new Sponsor();
        $picAmazon = 'amazon.png';
        $sponsor->setName('Amazon');
        copy(
            './src/DataFixtures/images/logos/' . $picAmazon,
            __DIR__ . '/../../public/uploads/images/logos/' . $picAmazon
        );
        $sponsor->setLogo($picAmazon);
        $sponsor->setLink('https://www.amazon.com/');
        $manager->persist($sponsor);

        $sponsor = new Sponsor();
        $picCoca = 'Coca-Cola_logo.png';
        $sponsor->setName('Coca cola');
        copy(
            './src/DataFixtures/images/logos/' . $picCoca,
            __DIR__ . '/../../public/uploads/images/logos/' . $picCoca
        );
        $sponsor->setLogo($picCoca);
        $sponsor->setLink('https://www.coca-cola-france.fr/');
        $manager->persist($sponsor);

        $sponsor = new Sponsor();
        $picIbm = 'IBM_logo.png';
        $sponsor->setName('IBM');
        copy(
            './src/DataFixtures/images/logos/' . $picIbm,
            __DIR__ . '/../../public/uploads/images/logos/' . $picIbm
        );
        $sponsor->setLogo($picIbm);
        $sponsor->setLink('https://www.ibm.com/fr-fr');
        $manager->persist($sponsor);

        $manager->flush();
    }
}
