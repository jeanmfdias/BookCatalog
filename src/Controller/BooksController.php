<?php

namespace App\Controller;

use App\DTO\Book\BookDto;
use App\DTO\Book\FilterDto;
use App\Exceptions\Book\BookHandleException;
use App\Form\BookCreateType;
use App\Form\BookEditType;
use App\Form\BookFilterType;
use App\Services\BooksService;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Pagination\PaginatorInterface;

final class BooksController extends ControllerBase
{
    public function __construct(private BooksService $booksService)
    { }

    #[Route('/books', name: 'books_index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $filter = new FilterDto();
        $filterForm = $this->createForm(BookFilterType::class, $filter);
        $filterForm->handleRequest($request);

        $booksQb = $this->booksService->listWithFilter($filter);

        $books = $paginator->query($booksQb)
            ->perPage(self::PER_PAGE)
            ->paginate();

        return $this->render('books/index.html.twig', [
            'books' => $books,
            'filterForm' => $filterForm,
        ]);
    }

    #[Route('/books/new', name: 'books_new')]
    public function new(Request $request): Response
    {
        $newBook = new BookDto();
        $createForm = $this->createForm(BookCreateType::class, $newBook);

        if ($request->isMethod('POST')) {
            try {
                $createForm->handleRequest($request);

                $book = $this->booksService->create($newBook);

                $this->addFlash('success', 'Livro criado com sucesso.');

                return $this->redirectToRoute('books_show', ['id' => $book->id]);
            } catch (BookHandleException $e) {
                $this->addFlash('error', $e->getMessage());
            } catch (Exception $e) {
                $this->addFlash('error', 'Erro interno ao salvar livro.');
            }
        }

        return $this->render('books/new.html.twig', [
            'createForm' => $createForm
        ]);
    }

    #[Route('/books/{id}', name: 'books_show', requirements: ['page' => '[0-9]+'])]
    public function show(int $id): Response
    {
        try {
            $bookDto = $this->booksService->getOne($id);
            return $this->render('books/show.html.twig', [
                'book' => $bookDto
            ]);
        } catch (BookHandleException $e) {
            $this->addFlash('error', $e->getMessage());
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao recuperar o livro.');
        }

        return $this->redirectToRoute('books_index');
    }

    #[Route('/books/{id}/edit', name: 'books_edit', methods: ['GET', 'PUT'])]
    public function edit(Request $request, int $id): Response
    {
        try {
            $bookEdit = $this->booksService->getOne($id);
            $editForm = $this->createForm(BookEditType::class, $bookEdit);

            if ($request->isMethod('PUT')) {

                $editForm->handleRequest($request);

                $book = $this->booksService->update($bookEdit);

                $this->addFlash('success', 'Livro editado com sucesso.');

                return $this->redirectToRoute('books_show', ['id' => $book->id]);
            }

            return $this->render('books/edit.html.twig', [
                'editForm' => $editForm,
                'book' => $bookEdit,
            ]);

        } catch (BookHandleException $e) {
            $this->addFlash('error', $e->getMessage());
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao atualizar livro.');
        }

        return $this->redirectToRoute('books_index');
    }

    #[Route('/books/{id}/delete', name: 'books_delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        try {
            $this->booksService->delete($id);
            $this->addFlash('success', "Registro #{$id} excluído com sucesso.");
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao excluír livro.');
        }

        return $this->redirectToRoute('books_index');
    }
}
