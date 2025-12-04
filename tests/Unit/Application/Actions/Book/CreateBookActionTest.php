<?php declare(strict_types=1);

namespace App\Tests\Application\Actions\Book;

use App\Application\Actions\Book\CreateBookAction;
use App\Application\Dto\Book\StoreBookInputDto;
use App\Application\Dto\Book\StoreBookOutputDto;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CreateBookActionTest extends TestCase
{
    public function testExecuteCreatesBookSuccessfully(): void
    {
        // Mock do EntityManager
        $emMock = $this->createMock(EntityManagerInterface::class);

        // Validando chamadas a persist() e flush()
        $emMock
            ->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Book::class));

        $emMock->expects($this->once())->method('flush');

        // Instância da action
        $action = new CreateBookAction($emMock);

        // DTO de entrada
        $dto = new StoreBookInputDto(
            title: 'New Book Title',
            description: 'A description',
            authors: ['John Doe', 'Jane Doe'],
            genders: ['Tech', 'Fantasy'],
            publisher: 'MegaBooks',
            national: true
        );

        // Vamos interceptar o persist para capturar a entidade criada
        $emMock
            ->method('persist')
            ->willReturnCallback(function (Book $book) {
                // Simula o ID gerado pelo banco usando Reflection
                $reflection = new \ReflectionClass($book);
                $idProp = $reflection->getProperty('id');
                $idProp->setAccessible(true);
                $idProp->setValue($book, 1);
            });

        // Execução
        $result = $action->execute($dto);

        // Verificando retorno
        $this->assertInstanceOf(StoreBookOutputDto::class, $result);

        // Verificando dados no DTO
        $this->assertSame('New Book Title', $result->title);
        $this->assertSame('A description', $result->description);
        $this->assertSame('John Doe, Jane Doe', $result->authors);
        $this->assertSame('Tech, Fantasy', $result->genders);
        $this->assertSame('MegaBooks', $result->publisher);
        $this->assertTrue($result->national);

        // Verificando datas
        $this->assertInstanceOf(\DateTime::class, $result->created_at);
        $this->assertInstanceOf(\DateTime::class, $result->updated_at);

        // Se quiser garantir que created_at e updated_at são iguais:
        $this->assertEquals(
            $result->created_at->format('Y-m-d H:i'),
            $result->updated_at->format('Y-m-d H:i'),
            'created_at and updated_at should match'
        );
    }
}
