<?php

namespace App\DataFixtures;

use App\Entity\Config;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConfigFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $configs = [
            ['name' => 'title', 'value' => 'Forum Name', 'type' => 'simple'],
            ['name' => 'desc', 'value' => 'No other bulletin board software offers a greater complement of features, while maintaining efficiency and ease of use.', 'type' => 'text'],
            ['name' => 'lang', 'value' => 'en', 'type' => 'simple'],
        ];

        foreach ($configs as $data) {
            $config = new Config();
            $config->setName($data['name']);
            $config->setValue($data['value']);
            $config->setType($data['type']);
            $manager->persist($config);
        }

        $manager->flush();
    }
}
