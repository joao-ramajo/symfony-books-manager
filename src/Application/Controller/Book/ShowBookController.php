<?php

declare(strict_types=1);

namespace App\Application\Controller\Book;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ShowBookController extends AbstractController
{
    #[Route('/books/{id}', name: 'list.books', methods: ['GET', 'HEAD'])]
    public function handle(Book $book)
    {
        return $this->json([
            'message' => 'Livro encontrado.',
            'data' => $book,
        ]);
    }
}
