<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Task;
use App\Entity\SubTask;
use App\Form\SubTaskType;

class TaskDetailsController extends AbstractController
{
    /**
     * @Route("/task/details/{id}", name="task_details")
     */
    public function index($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $this->getDoctrine()->getRepository(Task::class);
        $taskDetails = $repository->findBy(['id' => $id]);
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $subTasks = $task->getSubtasks();

        $subTask = new SubTask();
        $subTask->setTask($task);
        $form = $this->createForm(SubTaskType::class, $subTask);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$p = $form->getData();
            $entityManager->persist($subTask);
            $entityManager->flush();
        }

        return $this->render('task_details/index.html.twig', [
            'taskDetails' => $taskDetails,
            'subtasks' => $subTasks,
            'subtask_form' => $form->createView()
        ]);
    }
}
