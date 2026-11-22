<?php

namespace App\Controller;

use App\Entity\ViewBookAllDetail;
use App\Repository\ViewBookAllDetailRepository;
use App\Repository\ViewBookByAuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportsController extends ControllerBase
{
    public function __construct(
        private ViewBookByAuthorRepository $vwBookByAuthorRepository,
        private ViewBookAllDetailRepository $vwBookAllDetailRepository
    ) {
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

    #[Route('/reports/books-all-details', name: 'report_book_all_details', methods: 'GET')]
    public function bookAllDetails(): Response
    {
        $books = $this->vwBookAllDetailRepository->findAll();

        return $this->render('reports/book_all_details.html.twig', [
            'books' => $books
        ]);
    }
}
