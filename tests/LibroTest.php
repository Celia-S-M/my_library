<?php

namespace App\Tests\Entity;

use App\Entity\Libro;
use PHPUnit\Framework\TestCase;

class LibroTest extends TestCase
{
    public function testTitulo()
    {
        $libro = new Libro();
        $libro->setTitulo('El Quijote');
        $this->assertSame('El Quijote', $libro->getTitulo());
    }

    public function testAutor()
    {
        $libro = new Libro();
        $libro->setAutor('Miguel de Cervantes');
        $this->assertSame('Miguel de Cervantes', $libro->getAutor());
    }

    public function testGenero()
    {
        $libro = new Libro();
        $libro->setGenero('Novela');
        $this->assertSame('Novela', $libro->getGenero());
    }

    public function testAnoPublicacion()
    {
        $libro = new Libro();
        $libro->setAnoPublicacion('1605');
        $this->assertSame('1605', $libro->getAnoPublicacion());
    }
}
