<?php

namespace App\Controller;

use App\Form\Model\Registration;
use App\Form\Type\RegistrationType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends AbstractController
{

    public function registerAction()
    {
        $form = $this->createForm(RegistrationType::class, new Registration());

        return $this->render('Account/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Create User
     * @Route("/user/register", name="register")
     * @param Request $request
     */
    public function createAction(DocumentManager $dm, Request $request)
    {
        $form = $this->createForm(RegistrationType::class, new Registration());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration = $form->getData();

            $dm->persist($registration->getUser());
            $dm->flush();

            return $this->redirect('./base.html.twig');
        }

        return $this->render('Account/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}