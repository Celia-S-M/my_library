<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class AuthController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(#[CurrentUser] ?\App\Entity\Usuario $user): JsonResponse
    {


        $token = $this->container->get('lexik_jwt_authentication.jwt_manager')->create($user);

        return $this->json(['token' => $token]);
    }
}
