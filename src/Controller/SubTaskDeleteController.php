<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SubTask;
use Doctrine\ORM\EntityManagerInterface;

class SubTaskDeleteController extends AbstractController
{
    /**
     * @Route("/sub/task/delete/{id}", name="sub_task_delete")
     */
    public function index($id, EntityManagerInterface $entityManager): Response
    {
        $subTask = $this->getDoctrine()->getRepository(SubTask::class)->find($id);
        $entityManager->remove($subTask);
        $entityManager->flush();
        return $this->redirectToRoute('task_list');
    }
}
