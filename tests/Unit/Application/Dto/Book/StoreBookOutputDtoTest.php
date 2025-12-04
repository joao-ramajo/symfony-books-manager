<?php declare(strict_types=1);

namespace App\Tests\Application\Dto\Book;

use App\Application\Dto\Book\StoreBookOutputDto;
use App\Entity\Book;
use PHPUnit\Framework\TestCase;
use DateTime;

class StoreBookOutputDtoTest extends TestCase
{
    public function testDtoConstructor(): void
    {
        $now = new DateTime();
        $dto = new StoreBookOutputDto(
            id: 1,
            title: 'Clean Code',
            description: 'A book about software craftsmanship',
            authors: 'Robert C. Martin',
            genders: 'Technology',
            publisher: 'Prentice Hall',
            national: false,
            created_at: $now,
            updated_at: $now,
        );

        $this->assertSame(1, $dto->id);
        $this->assertSame('Clean Code', $dto->title);
        $this->assertSame('A book about software craftsmanship', $dto->description);
        $this->assertSame('Robert C. Martin', $dto->authors);
        $this->assertSame('Technology', $dto->genders);
        $this->assertSame('Prentice Hall', $dto->publisher);
        $this->assertFalse($dto->national);
        $this->assertSame($now, $dto->created_at);
        $this->assertSame($now, $dto->updated_at);
    }

    public function testDtoAllowsNullDescription(): void
    {
        $now = new DateTime();
        $dto = new StoreBookOutputDto(
            id: 10,
            title: 'Design Patterns',
            description: null,
            authors: 'GoF',
            genders: 'Software',
            publisher: 'Addison-Wesley',
            national: true,
            created_at: $now,
            updated_at: $now,
        );

        $this->assertNull($dto->description);
    }

    public function testFromEntityBuildsDtoCorrectly(): void
    {
        $book = new Book();

        $book->setId(99);
        $book->setTitle(' Domain-Driven Design ');
        $book->setDescription(null);
        $book->setAuthors('Eric Evans');
        $book->setGenders('Technology');
        $book->setPublisher(' Addison-Wesley ');
        $book->setNational(true);

        $now = new DateTime();
        $book->setCreatedAt($now);
        $book->setUpdatedAt($now);

        $dto = StoreBookOutputDto::fromEntity($book);

        $this->assertSame(99, $dto->id);
        $this->assertSame('Domain-Driven Design', $dto->title);
        $this->assertNull($dto->description);
        $this->assertSame('Eric Evans', $dto->authors);
        $this->assertSame('Technology', $dto->genders);
        $this->assertSame('Addison-Wesley', $dto->publisher);
        $this->assertTrue($dto->national);
        $this->assertSame($now, $dto->created_at);
        $this->assertSame($now, $dto->updated_at);
    }
}
