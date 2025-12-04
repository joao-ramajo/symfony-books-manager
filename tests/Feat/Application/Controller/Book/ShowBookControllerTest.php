<?php

declare(strict_types=1);

namespace App\Tests\Application\Controller\Book;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;

class ShowBookControllerTest extends WebTestCase
{
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $client = static::createClient();

        /** @var EntityManagerInterface */
        $this->em = $client->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->clearDatabase();
        self::ensureKernelShutdown();
    }

    private function clearDatabase(): void
    {
        $connection = $this->em->getConnection();
        $platform = $connection->getDatabasePlatform();

        $connection->executeStatement(
            $platform->getTruncateTableSQL('book', true)
        );
    }

    public function testShowBookReturnsCorrectData(): void
    {
        $client = static::createClient();

        // Arrange
        $book = new Book();
        $book->setTitle('Dom Casmurro');
        $book->setDescription('Um clássico da literatura brasileira.');
        $book->setAuthors('Machado de Assis');
        $book->setGenders('Romance');
        $book->setPublisher('Editora XPTO');
        $book->setNational(true);
        $book->setCreatedAt(new \DateTime());
        $book->setUpdatedAt(new \DateTime());

        $this->em->persist($book);
        $this->em->flush();

        // Act
        $client->request('GET', '/books/' . $book->getId());

        // Assert
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertSame('Livro encontrado.', $responseData['message']);
        $this->assertSame('Dom Casmurro', $responseData['data']['title']);
        $this->assertSame('Um clássico da literatura brasileira.', $responseData['data']['description']);
        $this->assertSame('Machado de Assis', $responseData['data']['authors']);
        $this->assertSame('Romance', $responseData['data']['genders']);
        $this->assertSame('Editora XPTO', $responseData['data']['publisher']);
        $this->assertTrue($responseData['data']['national']);
    }
}
