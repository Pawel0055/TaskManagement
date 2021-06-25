<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Task;
use App\Form\TaskType;
use App\Form\SubTaskType;
use App\Entity\SubTask;

class TaskEditController extends AbstractController
{
    /**
     * @Route("/task/edit/{id}", name="task_edit")
     */
    public function index($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush();
        }

        $subTasks = $this->getDoctrine()->getRepository(SubTask::class);
        $subtasks = $subTasks->findBy(
            ['task' => $task]);

        return $this->render('task_edit/index.html.twig', [
            'edit_task_form' => $form->createView(),
            'sub_task_list' => $subtasks,
        ]);
    }
}