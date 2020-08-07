<?php

namespace App\Manager;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\VarDumper\Dumper\esc;

class TaskManager
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * TaskManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Task $task
     */
    public function create(Task $task): void
    {
        $this->em->persist($task);
        $this->em->flush();
    }

    public function update(Task $task): void
    {
        $this->em->flush();
    }
}
