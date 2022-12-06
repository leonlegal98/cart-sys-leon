<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $product
                ->setName('Product ' . $i)
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua')
                ->setShortDescription('lorem isisbisbisi')
                ->setPrice(mt_rand(10, 600))
                ->setQuantity(mt_rand(10, 600));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
