<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 5; $i++) {
            $product = new Product();
            $product
                ->setName('Product ' . $i)
                ->setImage($faker->imageUrl(640, 480, 'fruits', true,'dogs',true))
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua')
                ->setQuantity(mt_rand(10, 600))
                ->setPrice($faker->randomFloat(2, 20, 30));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
