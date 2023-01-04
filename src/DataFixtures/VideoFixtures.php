<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Video;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public const NBR_VIDEOS = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (CategoryFixtures::CATEGORIES as $key) {
            for ($j = 1; $j <= self::NBR_VIDEOS; $j++) {
                $video = new Video();
                $video->setName($faker->sentence(2, true));
                $video->setDescription($faker->paragraph(2));
                $video->setCategory($this->getReference('category_' . $key));
                $video->setView($faker->numberBetween(1, 200));
                $video->setDuration($faker->numberBetween(2, 5));
                $video->setVideoFileName($faker->imageUrl(640, 480, 'animals', true));
                $manager->persist($video);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
