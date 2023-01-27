<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES_BACKGROUNDS = [
        'League of Legends' => 'LoL.jpg',
        'World of Warcraft' => 'world-warcraft-classic.Category.webp',
        'Rocket League' => 'rocket-leagueCategory.webp',
        'Overwatch 2' => 'overwatch-2Category.webp',
    ];

    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger, private Filesystem $filesystem)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $this->filesystem->remove(__DIR__ . '/../../public/uploads/images/backgrounds/');
        $this->filesystem->mkdir(__DIR__ . '/../../public/uploads/images/backgrounds/');

        foreach (self::CATEGORIES_BACKGROUNDS as $name => $categoryBg) {
            $category = new Category();
            $category->setName($name);
            copy(
                './src/DataFixtures/images/backgrounds/' . $categoryBg,
                __DIR__ . '/../../public/uploads/images/backgrounds/' . $categoryBg
            );
            $category->setBackground($categoryBg);
            $category->setSlug($this->slugger->slug($category->getName()));
            $this->addReference('category_' . $name, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
