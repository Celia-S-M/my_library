<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LibroControllerTest extends WebTestCase
{
    public function testCrearLibro()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/libros/', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'titulo' => 'El Quijote',
            'autor' => 'Miguel de Cervantes',
            'genero' => 'Novela',
            'anoPublicacion' => '1605',
        ]));

        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }

    public function testActualizarLibro()
    {
        $client = static::createClient();

        $crawler = $client->request('PUT', '/api/libros/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'titulo' => 'El Quijote - Edición Revisada',
        ]));

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testEliminarLibro()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/libros/1');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
