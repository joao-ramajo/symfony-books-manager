<?php declare(strict_types=1);

namespace App\Application\Actions\Book;

use App\Application\Dto\Book\StoreBookInputDto;
use App\Application\Dto\Book\StoreBookOutputDto;

class CreateBookAction
{
    public function execute(StoreBookInputDto $bookDto): StoreBookOutputDto
    {
        // ...

        // ...

        return new StoreBookOutputDto(
            random_int(1, 10),
            $bookDto->title,
            $bookDto->description,
            $bookDto->authors,
            $bookDto->genders,
            $bookDto->publisher,
            $bookDto->national
        );
    }
}
