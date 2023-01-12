<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BlogFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker ;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $categories = $manager->getRepository(Category::class)->findAll();
        for($i=0;$i<=30;$i++){
            $blog= new Blog();
            $blog->setTitle($faker->words(3,true))
                ->setContent($faker->paragraphs(3,true))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setCategory($categories[$faker->numberBetween(0,count($categories)-1)]);
            $manager->persist($blog);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
       return [Categoryfixtures::class];
    }
}
