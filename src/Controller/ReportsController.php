<?php

namespace App\Controller;

use App\Repository\ViewBookByAuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportsController extends ControllerBase
{
    public function __construct(private ViewBookByAuthorRepository $vwBookByAuthorRepository)
    {
        //
    }

    #[Route('/reports/books-by-authors', name: 'report_book_by_author', methods: 'GET')]
    public function bookByAuthors(): Response
    {
        $books = $this->vwBookByAuthorRepository->findAll();

        return $this->render('reports/book_by_authors.html.twig', [
            'books' => $books
        ]);
    }
}
