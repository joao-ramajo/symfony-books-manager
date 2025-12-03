<?php

namespace App\Application\Controller\Book;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ListBookController extends AbstractController
{
    #[Route('/books', name: 'list.books', methods: ['GET', 'HEAD'])]
    public function handle()
    {
        return new JsonResponse([
            'message' => 'Toma campitelli',
        ]);
    }
}