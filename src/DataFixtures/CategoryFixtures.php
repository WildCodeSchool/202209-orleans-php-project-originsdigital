<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        'League of Legends',
        'Teamfight Tactics',
        'CS:GO',
        'Call of Duty',
        'World of Warcraft',
        'FIFA',
        'Rocket League',
        'Overwatch 2',
        'Hearthstone',
        'Valorant',
        'Apex Legends',
        'Fortnite',
        'Rainbow 6 Siege',
        'Starcraft II',
        'Smash',
        'Les Sims 4',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $this->addReference('category_' . $categoryName, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
