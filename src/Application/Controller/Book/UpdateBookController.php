<?php declare(strict_types=1);

namespace App\Application\Controller\Book;

use App\Application\Actions\Book\UpdateBookAction;
use App\Application\Http\Requests\Book\UpdateBookRequest;
use App\Entity\Book;
use App\Infra\Mappers\BookMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UpdateBookController extends AbstractController
{
    public function __construct(
        public readonly UpdateBookAction $updateBookAction,
    )
    {}

    #[Route('/books/{id}', methods: ['PUT'])]
    public function handle(
        Book $book,
        #[MapRequestPayload] UpdateBookRequest $request
    ) {
        $bookDto = BookMapper::fromRequestToDto($request);

        $result = $this->updateBookAction->execute($bookDto, $book);

        return $this->json([
            'message' => 'Livro atualizado com sucesso',
            'data' => $result,
        ]);
    }
}
