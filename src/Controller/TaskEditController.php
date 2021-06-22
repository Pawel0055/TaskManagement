<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskEditController extends AbstractController
{
    /**
     * @Route("/task/edit", name="task_edit")
     */
    public function index(): Response
    {
        return $this->render('task_edit/index.html.twig', [
            'controller_name' => 'TaskEditController',
        ]);
    }
}
