<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CustomerRepository;


final class MainController extends AbstractController
{
    public function __invoke(Request $request, CustomerRepository $customerRepository): Response
    {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'] ?? 'Invité';
        return $this->render('main/index.html.twig', [
            'name' => $name,
        ]);
    }
}
