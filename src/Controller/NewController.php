<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewController extends AbstractController
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
    public function registrationAction(): Response
    {
        $form = $this->createForm(UserType::class, [], [
            'action' => 'registration',
            'attr' => [
                'id' => 'registrationForm'
                ]
            ]);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $newUser = new User();
            $newUser->setUserName($formData['userName']);
            $newUser->getPassword($formData['password']);

            $em->persist($newUser);
            $em->flush();

            return $this->redirect('homepage');
        }

        return $this->renderForm('userForm.html.twig', [
            'form' => $form
        ]);

    }
}
