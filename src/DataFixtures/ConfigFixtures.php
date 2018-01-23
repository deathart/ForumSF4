<?php

namespace App\DataFixtures;

use App\Entity\Config;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConfigFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $config_title = new Config();
        $config_title->setName('title');
        $config_title->setValue('Forum Name');
        $this->addReference('config_title', $config_title);

        $config_desc = new Config();
        $config_desc->setName('desc');
        $config_desc->setValue('No other bulletin board software offers a greater complement of features, while maintaining efficiency and ease of use.');
        $config_desc->setType('text');
        $this->addReference('config_desc', $config_desc);

        $config_lang = new Config();
        $config_lang->setName('lang');
        $config_lang->setValue('en');
        $this->addReference('config_lang', $config_lang);

        $manager->persist($config_title);
        $manager->persist($config_desc);
        $manager->persist($config_lang);
        $manager->flush();
    }
}
