<?php declare(strict_types=1);

namespace App\Application\Controller\Book;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class DeleteBookController extends AbstractController
{
    public function __construct(
        private BookRepository $bookRepository
    ) {}

    #[Route('/books/{id}', name: 'delete.books', methods: ['DELETE'])]
    public function handle(Book $book)
    {
        $this->bookRepository->delete($book);

        return $this->json([
            'message' => 'Livro apagado com sucesso.',
        ]);
    }
}
