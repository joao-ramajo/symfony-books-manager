<?php declare(strict_types=1);

namespace App\Tests\Application\Actions\Book;

use App\Application\Actions\Book\UpdateBookAction;
use App\Application\Dto\Book\StoreBookInputDto;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class UpdateBookActionTest extends TestCase
{
    public function testExecuteUpdatesBookCorrectly(): void
    {
        // Mock do EntityManager
        $emMock = $this->createMock(EntityManagerInterface::class);

        // Deve chamar flush() exatamente uma vez
        $emMock->expects($this->once())->method('flush');

        // Instância da Action
        $action = new UpdateBookAction($emMock);

        // DTO de entrada
        $dto = new StoreBookInputDto(
            title: 'Updated Title',
            description: 'Updated Description',
            authors: ['John Doe', 'Jane Doe'],
            genders: ['Tech', 'Sci-Fi'],
            publisher: 'Any Publisher',
            national: true
        );

        // Entidade simulada (normalmente carregada via repository)
        $book = new Book();
        $book->setTitle('Old Title');
        $book->setDescription('Old Description');
        $book->setAuthors('Old Author');
        $book->setGenders('Old Gender');
        $book->setUpdatedAt(new \DateTime('-1 day'));

        // Execução
        $result = $action->execute($dto, $book);

        // Asserções
        $this->assertSame('Updated Title', $book->getTitle());
        $this->assertSame('Updated Description', $book->getDescription());
        $this->assertSame('John Doe, Jane Doe', $book->getAuthors());
        $this->assertSame('Tech, Sci-Fi', $book->getGenders());

        // Data atualizada
        $this->assertInstanceOf(\DateTime::class, $book->getUpdatedAt());
        $this->assertGreaterThan(
            new \DateTime('-10 seconds'),
            $book->getUpdatedAt(),
            'UpdatedAt should be recent'
        );

        // O execute deve retornar o próprio Book
        $this->assertSame($book, $result);
    }
}
