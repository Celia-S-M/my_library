<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "El título no puede estar vacío")]
    private ?string $titulo = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "El autor no puede estar vacío")]
    private ?string $autor = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "El género no puede estar vacío")]
    private ?string $genero = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank(message: "El año de publicación no puede estar vacío")]
    #[Assert\Positive(message: "El año de publicación debe ser un número positivo")]
    private ?string $anoPublicacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): static
    {
        $this->autor = $autor;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getAnoPublicacion(): ?string
    {
        return $this->anoPublicacion;
    }

    public function setAnoPublicacion(string $anoPublicacion): static
    {
        $this->anoPublicacion = $anoPublicacion;

        return $this;
    }

}
