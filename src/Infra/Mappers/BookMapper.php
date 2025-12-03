<?php declare(strict_types=1);

namespace App\Infra\Mappers;

use App\Application\Dto\Book\StoreBookInputDto;
use App\Application\Http\Requests\Book\StoreBookRequest;
use App\Entity\Book;

class BookMapper
{
    public static function fromRequestToDto(StoreBookRequest $request): StoreBookInputDto
    {
        return new StoreBookInputDto(
            title: trim($request->title),
            description: $request->description ? trim($request->description) : null,
            authors: array_map('trim', $request->authors),
            genders: array_map('trim', $request->genders),
            publisher: trim($request->publisher),
            national: $request->national
        );
    }

}
