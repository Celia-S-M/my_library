<?php

namespace App\Tests\Entity;

use App\Entity\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    public function testNombre()
    {
        $usuario = new Usuario();
        $usuario->setNombre('Juan Pérez');
        $this->assertSame('Juan Pérez', $usuario->getNombre());
    }

    public function testEmail()
    {
        $usuario = new Usuario();
        $usuario->setEmail('juan.perez@example.com');
        $this->assertSame('juan.perez@example.com', $usuario->getEmail());
    }

    public function testEdad()
    {
        $usuario = new Usuario();
        $usuario->setEdad(30);
        $this->assertSame(30, $usuario->getEdad());
    }
}

