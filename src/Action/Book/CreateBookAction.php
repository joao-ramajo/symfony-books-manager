<?php declare(strict_types=1);

namespace App\Action\Book;

use App\Dto\Book\StoreBookInputDto;
use App\Dto\Book\StoreBookOutputDto;

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
