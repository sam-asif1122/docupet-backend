<?php

namespace App\DataFixtures;

use App\Entity\Pet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 7; $i++) {

            $pet = new Pet();
            $pet->setName('petName ' . $i);
            $pet->setType(array_rand(['Dog', 'Cat']));
            $pet->setBreed('breed' . array_rand(['0', '1']));
            $pet->setNo("nil");
            $pet->setGender(array_rand(['Male', 'Female']));

            $manager->persist($pet);

        }

        $manager->persist($pet);

        $manager->flush();
    }
}
