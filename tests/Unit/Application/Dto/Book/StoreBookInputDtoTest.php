<?php declare(strict_types=1);

namespace App\Tests\Application\Dto\Book;

use App\Application\Dto\Book\StoreBookInputDto;
use PHPUnit\Framework\TestCase;

class StoreBookInputDtoTest extends TestCase
{
    public function testDtoIsCreatedWithValidData(): void
    {
        $dto = new StoreBookInputDto(
            title: 'Clean Code',
            description: 'A book about writing readable code.',
            authors: ['Robert C. Martin'],
            genders: ['Software', 'Programming'],
            publisher: 'Pearson',
            national: false
        );

        $this->assertSame('Clean Code', $dto->title);
        $this->assertSame('A book about writing readable code.', $dto->description);
        $this->assertSame(['Robert C. Martin'], $dto->authors);
        $this->assertSame(['Software', 'Programming'], $dto->genders);
        $this->assertSame('Pearson', $dto->publisher);
        $this->assertFalse($dto->national);
    }

    public function testDtoAllowsNullableDescription(): void
    {
        $dto = new StoreBookInputDto(
            title: 'Domain-Driven Design',
            description: null,
            authors: ['Eric Evans'],
            genders: ['Architecture'],
            publisher: 'Addison-Wesley',
            national: true
        );

        $this->assertNull($dto->description);
    }
}
