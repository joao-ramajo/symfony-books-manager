<?php declare(strict_types=1);

namespace App\Controller\Book;

use App\Action\Book\CreateBookAction;
use App\Dto\Book\StoreBookInputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class StoreBookController extends AbstractController
{
    public function __construct(
        public readonly CreateBookAction $createBookAction
    ) {}

    #[Route('/books', name: 'store.books', methods: ['POST'])]
    public function handle(
        #[MapRequestPayload] StoreBookInputDto $bookDto
    ): JsonResponse {
        $result = $this->createBookAction->execute($bookDto);

        return $this->json([
            'message' => 'Livro criado com sucesso',
            'data' => $result,
        ]);
    }
}