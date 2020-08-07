<?php

namespace App\Controller;

use App\Entity\Task;
use App\Manager\TaskManager;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var TaskRepository
     */
    protected TaskRepository $tasks;

    /**
     * @var TaskManager
     */
    protected TaskManager $manager;

    /**
     * DefaultController constructor.
     * @param TaskRepository $tasks
     * @param TaskManager $manager
     */
    public function __construct(TaskRepository $tasks, TaskManager $manager)
    {
        $this->tasks = $tasks;
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'tasks' => $this->tasks->findUndoneByDate(new \DateTime()),
        ]);
    }

    /**
     * @Route("/task/{id}/done", name="mark_as_done")
     */
    public function markAsDone(Task $task)
    {
        if (!$task->getDone()) {
            $task->setDone(true);
            $this->manager->update($task);
        }

        return $this->redirectToRoute('default');
    }
}
