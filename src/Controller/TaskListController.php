<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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

    /**
    * @Route("/task/changeStatus", name="changeStatus")
    */
    public function changeStatus(Request $request, EntityManagerInterface $entityManager)
    {
        $list = $_POST['data'];
        $id = $_POST['id'];
        $changeId = 2;
        if($list[0] == "item_2")
            $changeId = 2;
        elseif($list[0] == "item_1")
            $changeId = 1;
        else
            $changeId = 0;
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);

        $task->setStatus($changeId);
        $entityManager->persist($task);
        $entityManager->flush();
        return new Response('Saved new status');
    }
}