<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Video;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public const NBR_VIDEOS = 10;

    public function __construct(private Filesystem $filesystem)
    {
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $this->filesystem->remove(__DIR__ . '/../../public/uploads/videos/');
        $this->filesystem->mkdir(__DIR__ . '/../../public/uploads/videos/');

        foreach (CategoryFixtures::CATEGORIES as $key => $categoryName) {
            for ($j = 1; $j <= self::NBR_VIDEOS; $j++) {
                $video = new Video();
                $video->setName($faker->sentence(2, true));
                $video->setDescription($faker->paragraph(2));
                $video->setCategory($this->getReference('category_' . $key));
                $video->setView($faker->numberBetween(1, 200));
                $video->setDuration($faker->numberBetween(2, 5));
                $videoName = 'video' . (rand(1, 3) . '.mp4');
                copy('./src/DataFixtures/videos/' . $videoName, __DIR__ . '/../../public/uploads/videos/' . $videoName);
                $video->setVideo($videoName);
                $video->setPublic($faker->boolean());
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
