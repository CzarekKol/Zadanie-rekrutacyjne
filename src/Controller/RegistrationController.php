<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function registrationAction(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, [
            'action' => '/registration',
            'attr' => [
                'id' => 'registrationForm'
                ]
            ]);
            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $formData = $form->getData();

            $em->persist($formData);
            $em->flush();

            return $this->redirect('/login');
        }

        return $this->renderForm('userForm.html.twig', [
            'form' => $form
        ]);
    }
}

