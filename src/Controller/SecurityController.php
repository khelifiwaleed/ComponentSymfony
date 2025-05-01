<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SecurityController extends AbstractController
{
    public function login(): JsonResponse
    {
        $user = $this->getUser();
        return $this->json([
            "user" => $user,
            "roles" => $user->getRoles(),
        ]);

    }

}