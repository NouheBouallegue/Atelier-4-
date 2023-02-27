<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Classroom;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Classroom::class);
        $classrooms = $repo->findAll();
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController', 'classrooms'=>$classrooms
        ]);
    }
    #[Route('/addClassroom', name: 'add_classroom')]
    public function addClassroom(ManagerRegistry $doctrine){
    
        $classroom= new Classroom();
        $classroom->setName('C');
        $em=$doctrine->getManager();
        $em->persist($classroom); 
        $em->flush();
        return $this->redirectToRoute('app_classroom');
    }

        #[Route('/updateClassroom/{id}', name: 'update_classroom')]
        public function updateClassroom($id,ManagerRegistry $doctrine){
            $classroom=$doctrine->getRepository(Classroom::class)->find($id);
            $classroom->setName('classroom updated');
            $em=$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_classroom');
    }

    #[Route('/deleteClassroom/{id}', name: 'delete_classroom')]
    public function deleteStudent($id, ManagerRegistry $doctrine){
        $classroom=$doctrine->getRepository(Classroom::class)->find($id);
        $em=$doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('app_classroom');
    }

    }


  

