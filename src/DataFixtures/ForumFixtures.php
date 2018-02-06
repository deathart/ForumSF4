<?php

namespace App\DataFixtures;

use App\Entity\Forum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ForumFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $forums = [
            ['name' => 'Announce', 'desc' => 'You will find all the announcements concerning the forum', 'slug' => 'announce', 'category' => 1, 'position' => 1, 'parent' => 0],
            ['name' => 'Suggests & Bugs', 'desc' => 'Suggests & Bugs Forum', 'slug' => 'suggests-and-bugs', 'category' => 1, 'position' => 2, 'parent' => 0],
            ['name' => 'Suggests', 'desc' => 'Suggests Forum', 'slug' => 'suggests', 'category' => 1, 'position' => 1, 'parent' => 2],
            ['name' => 'Bugs', 'desc' => 'Bugs Forum', 'slug' => 'bugs', 'category' => 1, 'position' => 2, 'parent' => 2],
            ['name' => 'Updates', 'desc' => 'Come and discover all the updates', 'slug' => 'updates', 'category' => 1, 'position' => 3, 'parent' => 0],
            ['name' => 'Presentation', 'desc' => 'Come and introduce yourself', 'slug' => 'presentation', 'category' => 2, 'position' => 1, 'parent' => 0],
            ['name' => 'Bar', 'desc' => 'Come and discuss everything', 'slug' => 'bar', 'category' => 2, 'position' => 2, 'parent' => 0],
        ];

        foreach ($forums as $data) {
            $forum = new Forum();
            $forum->setName($data['name']);
            $forum->setDescription($data['desc']);
            $forum->setSlug($data['slug']);
            $forum->setCategory($data['category']);
            $forum->setPosition($data['position']);
            $forum->setParent($data['parent']);

            $manager->persist($forum);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
