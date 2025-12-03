<?php declare(strict_types=1);

namespace App\Application\Actions\Book;

use App\Application\Dto\Book\StoreBookInputDto;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class UpdateBookAction
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    public function execute(StoreBookInputDto $bookDto, Book $book): Book
    {
        $authors = implode(', ', $bookDto->authors);
        $genders = implode(', ', $bookDto->genders);

        $now = new \DateTime();

        $book->setTitle($bookDto->title);
        $book->setDescription($bookDto->description);
        $book->setAuthors($authors);
        $book->setGenders($genders);
        $book->setUpdatedAt($now);

        $this->em->flush();

        return $book;
    }
}
