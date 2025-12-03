<?php

namespace App\Application\Controller\Book;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ListBookController extends AbstractController
{
    public function __construct(
        private BookRepository $bookRepository
    ) {}

    #[Route('/books', name: 'list.books', methods: ['GET', 'HEAD'])]
    public function handle(Request $request)
    {
        $page = (int) $request->query->get('page', 1);
        $limit = (int) $request->query->get('limit', 10);

        $paginator = $this->bookRepository->paginate($page, $limit);

        return $this->json([
            'data' => $paginator,
            'total' => count($paginator),
            'page' => $page,
            'limit' => $limit,
            'pages' => ceil(count($paginator) / $limit),
        ]);
    }
}
