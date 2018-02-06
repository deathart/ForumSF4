<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            ['name' => 'General', 'desc' => 'This is the general category', 'slug' => 'general', 'position' => 1],
            ['name' => 'Community', 'desc' => 'This is the categories for the community', 'slug' => 'community', 'position' => 2],
        ];

        foreach ($categories as $data) {
            $category = new Category();
            $category->setName($data['name']);
            $category->setDescription($data['desc']);
            $category->setSlug($data['slug']);
            $category->setPosition($data['position']);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
