<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    #[Route('/message', name: 'app_message')]
    public function index(): Response
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }
    #[Route('/send', name: 'app_send')]
    public function send(Request $request,ManagerRegistry $doctrine): Response
    {
        $message = new Messages;
        $form = $this->createForm(MessagesType::class, $message,);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $message->setSender($this->getUser());

            $em =$doctrine->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash("message", "Message envoyé avec succès.");
            return $this->redirectToRoute("app_message");
        }
        return $this->render('message/send.html.twig', [
            "form" => $form->createView(),
        ]);

        
    }
    #[Route('/received', name: 'app_received')]
    public function received(): Response
    {
        return $this->render('message/received.html.twig');
 
            
}
#[Route('/read/{id}', name: 'app_read')]
public function read(Messages $message,ManagerRegistry $doctrine): Response
    {
        $message->setIsRead(true);
        $em =$doctrine->getManager();
        $em->persist($message);
        $em->flush();

        return $this->render('message/read.html.twig', compact("message"));
    }

    #[Route('/delete/{id}', name: 'app_delete')]    
    public function delete(Messages $message,ManagerRegistry $doctrine): Response
    {
        $em =$doctrine->getManager();
        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute("app_received");
    }
    #[Route('/sent', name: 'app_sent')]
    public function sent(): Response
    {
        return $this->render('message/sent.html.twig');
    }
}

