<?php declare(strict_types=1);

namespace App\Application\Dto\Book;

use App\Entity\Book;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

class StoreBookOutputDto
{
    /**
     * @param int $id
     * @param string $title
     * @param string|null $description
     * @param string[] $authors
     * @param string[] $genders
     * @param string $publisher
     * @param bool $national
     */
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        public readonly int $id,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public readonly string $title,

        #[Assert\Type('string')]
        public readonly ?string $description = null,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public readonly string $authors,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public readonly string $genders,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public readonly string $publisher,

        // #[Assert\NotBlank]
        #[Assert\Type('boolean')]
        public readonly bool $national,

        public readonly DateTime $created_at,
        public readonly DateTime $updated_at,
    ) {}

    public static function fromEntity(Book $book): Self
    {
        return new Self(
            id: $book->getId(),
            title: trim($book->getTitle()),
            description: $book->getDescription() ? $book->getDescription() : null,
            authors: $book->getAuthors(),
            genders: $book->getGenders(),
            publisher: trim($book->getPublisher()),
            national: $book->isNational(),
            created_at: $book->getCreatedAt(),
            updated_at: $book->getUpdatedAt(),
        );
    }
}
