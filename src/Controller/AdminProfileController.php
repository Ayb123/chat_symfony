<?php



namespace App\Controller;



use App\Entity\User;

use App\Form\UserType;

use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;



#[Route('/admin/profile')]

class AdminProfileController extends AbstractController

{

    #[Route('/', name: 'app_admin_profile_index', methods: ['GET'])]

    public function index(UserRepository $userRepository): Response

    {

        return $this->render('admin_profile/index.html.twig', [

            'users' => $userRepository->findAll(),

        ]);

    }



    #[Route('/new', name: 'app_admin_profile_new', methods: ['GET', 'POST'])]

    public function new(Request $request, UserRepository $userRepository): Response

    {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $userRepository->save($user, true);



            return $this->redirectToRoute('app_admin_profile_index', [], Response::HTTP_SEE_OTHER);

        }



        return $this->renderForm('admin_profile/new.html.twig', [

            'user' => $user,

            'form' => $form,

        ]);

    }



    #[Route('/{id}', name: 'app_admin_profile_show', methods: ['GET'])]

    public function show(User $user): Response

    {

        return $this->render('admin_profile/show.html.twig', [

            'user' => $user,

        ]);

    }



    #[Route('/{id}', name: 'app_admin_profile_delete', methods: ['POST'])]

    public function delete(Request $request, User $user, UserRepository $userRepository): Response

    {

        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {

            $userRepository->remove($user, true);

        }



        return $this->redirectToRoute('app_admin_profile_index', [], Response::HTTP_SEE_OTHER);

    }

}