<?php

namespace App\Controller;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

final class UsercontrollerController extends AbstractController
{
    #[Route('/usercontroller', name: 'app_usercontroller')]
    public function index(): Response
    {
        return $this->render('usercontroller/index.html.twig', [
            'controller_name' => 'UsercontrollerController',
        ]);
    }
   
  #[Route('/user/add', name: 'user_add')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $user = new User();
        $user->setName('ahmed');   
       

        $em->persist($user);
        $em->flush();
        
        return new Response('dfghjk', Response::HTTP_CREATED);

    }

    #[Route('/user/{id}/update', name: 'user_update_fixed', methods: ['GET'])]
    public function update(int $id, ManagerRegistry $doctrine): Response
    {
        $em   = $doctrine->getManager();
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) { return new Response('User not found', 404); }

        $user->setName('ahmedddddddd');
    

        $em->flush();
        return new Response(' updated');
    }



    
}

