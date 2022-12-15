<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Video;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VideoFixtures extends Fixture
{
    public const NBR_VIDEOS = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= self::NBR_VIDEOS; $i++) {
            $video = new Video();
            $video->setName($faker->sentence(2, true));
            $video->setDescription($faker->paragraph(2));
            $video->setCategory($faker->word());
            $video->setTags($faker->word());
            $video->setViews($faker->numberBetween(1, 200));
            $video->setDurations($faker->numberBetween(2, 5));
            $video->setImageFileName($faker->imageUrl(640, 480, 'animals', true));
            $manager->persist($video);
        }

        $manager->flush();
    }
}
