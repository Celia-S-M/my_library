<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsuarioControllerTest extends WebTestCase
{
    public function testCrearUsuario()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/usuarios', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'nombre' => 'Juan Pérez',
            'email' => 'juan.perez@example.com',
            'password' => '123456',
            'edad' => 30,
        ]));

        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }

    public function testActualizarUsuario()
    {
        $client = static::createClient();

        $crawler = $client->request('PUT', '/api/usuarios/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'nombre' => 'Nuevo Nombre',
        ]));

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testEliminarUsuario()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/usuarios/1');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
