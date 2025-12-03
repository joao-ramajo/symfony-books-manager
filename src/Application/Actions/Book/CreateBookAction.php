<?php declare(strict_types=1);

namespace App\Application\Actions\Book;

use App\Application\Dto\Book\StoreBookInputDto;
use App\Application\Dto\Book\StoreBookOutputDto;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class CreateBookAction
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManger
    ) {}

    public function execute(StoreBookInputDto $bookDto): StoreBookOutputDto
    {
        $book = new Book();

        $authors = implode(', ', $bookDto->authors);
        $genders = implode(', ', $bookDto->genders);
        $now = new \DateTime();

        $book->setTitle($bookDto->title);
        $book->setDescription($bookDto->description);
        $book->setAuthors($authors);
        $book->setGenders($genders);
        $book->setPublisher($bookDto->publisher);
        $book->setNational($bookDto->national);
        $book->setCreatedAt($now);
        $book->setUpdatedAt($now);

        $this->entityManger->persist($book);

        $this->entityManger->flush();

        return StoreBookOutputDto::fromEntity($book);
    }
}
