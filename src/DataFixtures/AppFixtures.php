<?php

namespace App\DataFixtures;

use App\Factory\GroupFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne();
        GroupFactory::createMany(10);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
