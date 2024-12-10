<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api/usuarios')]
class UsuarioController extends AbstractController
{
    #[Route('/', name: 'api_usuarios_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher): Response
    {
        $data = json_decode($request->getContent(), true);

        $usuario = new Usuario();
        $usuario->setNombre($data['nombre']);
        $usuario->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword($usuario, $data['password']);
        $usuario->setPassword($hashedPassword);
        $usuario->setEdad($data['edad']);

        // Validar
        $errors = $validator->validate($usuario);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString, 400);
        }

        $entityManager->persist($usuario);
        $entityManager->flush();

        return $this->json(['status' => 'Usuario creado'], 201);
    }

    #[Route('/{id}', name: 'api_usuarios_update', methods: ['PUT'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager, UsuarioRepository $usuarioRepository, ValidatorInterface $validator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $data = json_decode($request->getContent(), true);
        $usuario = $usuarioRepository->find($id);

        if (!$usuario) {
            return $this->json(['status' => 'Usuario no encontrado'], 404);
        }

        $usuario->setNombre($data['nombre'] ?? $usuario->getNombre());
        $usuario->setEmail($data['email'] ?? $usuario->getEmail());
        $usuario->setEdad($data['edad'] ?? $usuario->getEdad());

        $errors = $validator->validate($usuario);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString, 400);
        }

        $entityManager->flush();

        return $this->json(['status' => 'Usuario actualizado'], 200);
    }

    #[Route('/{id}', name: 'api_usuarios_delete', methods: ['DELETE'])]
    public function delete(int $id, UsuarioRepository $usuarioRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $usuario = $usuarioRepository->find($id);

        if (!$usuario) {
            return $this->json(['status' => 'Usuario no encontrado'], 404);
        }

        $entityManager->remove($usuario);
        $entityManager->flush();

        return $this->json(['status' => 'Usuario eliminado'], 200);
    }
}
