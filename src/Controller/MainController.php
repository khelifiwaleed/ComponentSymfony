<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CustomerRepository;


final class MainController extends AbstractController
{
    public function __invoke(CustomerRepository $customerRepository): Response
    {
        dd($customerRepository->findAll());
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
