<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;

class TaskListController extends AbstractController
{
    /**
     * @Route("/task/list", name="task_list")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush();
        }

        $repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $repository->findAll();
        return $this->render('task_list/index.html.twig', [
            'controller_name' => 'TaskListController',
            'tasks' => $tasks,
            'task_form' => $form->createView()
        ]);
    }
}
