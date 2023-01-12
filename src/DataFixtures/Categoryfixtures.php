<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Categoryfixtures extends Fixture
{
    private $categories = ['Coding', 'Gaming','Network','Security','Hacking'];

    public function load(ObjectManager $manager): void
    {
       foreach($this->categories as $categorie){
           $cat= new Category();
           $cat->setName($categorie);
           $manager->persist($cat);
       }
        $manager->flush();
    }
}
