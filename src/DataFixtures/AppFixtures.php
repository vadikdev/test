<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            for ($j = 1; $j <= 10; $j++) {
                $task = new Task();
                $task
                    ->setDate(new \DateTime(sprintf('+%s days', $i)))
                    ->setTitle(sprintf('Task #%s', $j));
                $manager->persist($task);
            }
            $manager->flush();
        }
    }
}
