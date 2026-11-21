<?php

namespace App\Controller;

use App\DTO\Author\AuthorDto;
use App\DTO\Author\FilterDto;
use App\Exceptions\Author\AuthorHandleException;
use App\Form\AuthorCreateType;
use App\Form\AuthorEditType;
use App\Form\AuthorFilterType;
use App\Services\AuthorsService;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Pagination\PaginatorInterface;

final class AuthorsController extends ControllerBase
{
    public function __construct(private AuthorsService $authorsService)
    { }

    #[Route('/authors', name: 'authors_index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $filter = new FilterDto();
        $filterForm = $this->createForm(AuthorFilterType::class, $filter);
        $filterForm->handleRequest($request);

        $authorsQb = $this->authorsService->listWithFilter($filter);

        $authors = $paginator->query($authorsQb)
            ->perPage(self::PER_PAGE)
            ->paginate();

        return $this->render('authors/index.html.twig', [
            'authors' => $authors,
            'filterForm' => $filterForm,
        ]);
    }

    #[Route('/authors/new', name: 'authors_new')]
    public function new(Request $request): Response
    {
        $newAuthor = new AuthorDto();
        $createForm = $this->createForm(AuthorCreateType::class, $newAuthor);

        if ($request->isMethod('POST')) {
            try {
                $createForm->handleRequest($request);

                $author = $this->authorsService->create($newAuthor);

                $this->addFlash('success', 'Autor criado com sucesso.');

                return $this->redirectToRoute('authors_show', ['id' => $author->id]);
            } catch (AuthorHandleException $e) {
                $this->addFlash('error', $e->getMessage());
            } catch (Exception $e) {
                $this->addFlash('error', 'Erro interno ao salvar autor.');
            }
        }

        return $this->render('authors/new.html.twig', [
            'createForm' => $createForm
        ]);
    }

    #[Route('/authors/{id}', name: 'authors_show', requirements: ['page' => '[0-9]+'])]
    public function show(int $id): Response
    {
        try {
            $authorDto = $this->authorsService->getOne($id);

            return $this->render('authors/show.html.twig', [
                'author' => $authorDto
            ]);
        } catch (AuthorHandleException $e) {
            $this->addFlash('error', $e->getMessage());
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao recuperar o autor.');
        }

        return $this->redirectToRoute('authors_index');
    }

    #[Route('/authors/{id}/edit', name: 'authors_edit', methods: ['GET', 'PUT'])]
    public function edit(Request $request, int $id): Response
    {
        try {
            $authorEdit = $this->authorsService->getOne($id);
            $editForm = $this->createForm(AuthorEditType::class, $authorEdit);

            if ($request->isMethod('PUT')) {
                $editForm->handleRequest($request);
                $author = $this->authorsService->update($authorEdit);

                $this->addFlash('success', 'Autor editado com sucesso.');
                return $this->redirectToRoute('authors_show', ['id' => $author->id]);
            }

            return $this->render('authors/edit.html.twig', [
                'editForm' => $editForm,
                'author' => $authorEdit,
            ]);
        } catch (AuthorHandleException $e) {
            $this->addFlash('error', $e->getMessage());
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao atualizar o autor.');
        }

        return $this->redirectToRoute('authors_index');
    }

    #[Route('/authors/{id}/delete', name: 'authors_delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        try {
            $this->authorsService->delete($id);
            $this->addFlash('success', "Registro #{$id} excluído com sucesso.");
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao excluir o autor.');
        }
        return $this->redirectToRoute('authors_index');
    }
}
