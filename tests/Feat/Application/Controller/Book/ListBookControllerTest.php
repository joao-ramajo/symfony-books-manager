<?php declare(strict_types=1);

namespace App\Tests\Application\Controller\Book;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListBookControllerTest extends WebTestCase
{
    public function testListBooksReturnsPaginatedResponse(): void
    {
        $client = static::createClient();

        // Faz a requisição GET real
        $client->request('GET', '/books?page=1&limit=10');

        // Deve retornar 200
        $this->assertResponseIsSuccessful();

        // Pegar conteúdo JSON da resposta
        $response = $client->getResponse()->getContent();
        $data = json_decode($response, true);

        // Valida estrutura
        $this->assertIsArray($data);
        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('total', $data);
        $this->assertArrayHasKey('page', $data);
        $this->assertArrayHasKey('limit', $data);
        $this->assertArrayHasKey('pages', $data);

        // Tipos esperados
        $this->assertIsArray($data['data']);
        $this->assertIsInt($data['total']);
        $this->assertIsInt($data['page']);
        $this->assertIsInt($data['limit']);
        $this->assertIsInt($data['pages']);
    }
}
