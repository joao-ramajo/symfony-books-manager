<?php declare(strict_types=1);

namespace App\Application\Dto\Book;

use Symfony\Component\Validator\Constraints as Assert;

class StoreBookInputDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public readonly string $title,

        #[Assert\Type('string')]
        public readonly ?string $description = null,

        #[Assert\NotBlank]
        #[Assert\All([
            new Assert\Type('string'),
            new Assert\NotBlank
        ])]
        public readonly array $authors,

        #[Assert\NotBlank]
        #[Assert\Type('array')]
        #[Assert\All([
            new Assert\Type('string'),
            new Assert\NotBlank
        ])]
        public readonly array $genders,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public readonly string $publisher,

        // #[Assert\NotBlank]
        #[Assert\Type('boolean')]
        public readonly bool $national,
    ) {}
}
