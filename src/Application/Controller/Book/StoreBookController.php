<?php declare(strict_types=1);

namespace App\Application\Controller\Book;

use App\Application\Actions\Book\CreateBookAction;
use App\Application\Http\Requests\Book\StoreBookRequest;
use App\Infra\Mappers\BookMapper;
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
        #[MapRequestPayload] StoreBookRequest $bodyRequest
    ): JsonResponse {
        $bookDto = BookMapper::fromRequestToDto($bodyRequest);

        $result = $this->createBookAction->execute($bookDto);

        return $this->json([
            'message' => 'Livro criado com sucesso',
            'data' => $result,
        ]);
    }
}
