<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Repository\LibroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/libros')]
class LibroController extends AbstractController
{
    #[Route('/', name: 'api_libros_index', methods: ['GET'])]
    public function index(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findAll();
        $data = [];

        foreach ($libros as $libro) {
            $data[] = [
                'id' => $libro->getId(),
                'titulo' => $libro->getTitulo(),
                'autor' => $libro->getAutor(),
                'genero' => $libro->getGenero(),
                'anoPublicacion' => $libro->getAnoPublicacion(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/', name: 'api_libros_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $data = json_decode($request->getContent(), true);

        $libro = new Libro();
        $libro->setTitulo($data['titulo']);
        $libro->setAutor($data['autor']);
        $libro->setGenero($data['genero']);
        $libro->setAnoPublicacion($data['anoPublicacion']);

        // Validar
        $errors = $validator->validate($libro);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString, 400);
        }

        $entityManager->persist($libro);
        $entityManager->flush();

        return $this->json(['status' => 'Libro creado'], 201);
    }

    #[Route('/{id}', name: 'api_libros_update', methods: ['PUT'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager, LibroRepository $libroRepository, ValidatorInterface $validator): Response
    {
        $data = json_decode($request->getContent(), true);
        $libro = $libroRepository->find($id);

        if (!$libro) {
            return $this->json(['status' => 'Libro no encontrado'], 404);
        }

        $libro->setTitulo($data['titulo'] ?? $libro->getTitulo());
        $libro->setAutor($data['autor'] ?? $libro->getAutor());
        $libro->setGenero($data['genero'] ?? $libro->getGenero());
        $libro->setAnoPublicacion($data['anoPublicacion'] ?? $libro->getAnoPublicacion());

        // Validar
        $errors = $validator->validate($libro);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString, 400);
        }

        $entityManager->flush();

        return $this->json(['status' => 'Libro actualizado'], 200);
    }

    #[Route('/{id}', name: 'api_libros_delete', methods: ['DELETE'])]
    public function delete(int $id, LibroRepository $libroRepository, EntityManagerInterface $entityManager): Response
    {
        $libro = $libroRepository->find($id);

        if (!$libro) {
            return $this->json(['status' => 'Libro no encontrado'], 404);
        }

        $entityManager->remove($libro);
        $entityManager->flush();

        return $this->json(['status' => 'Libro eliminado'], 200);
    }
}
