<?php

namespace App\Controller;

use App\DTO\Subject\FilterDto;
use App\DTO\Subject\SubjectDto;
use App\Exceptions\Subject\SubjectHandleException;
use App\Form\CreateSubjectType;
use App\Form\EditSubjectType;
use App\Form\SubjectFilterType;
use App\Services\SubjectsService;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Pagination\PaginatorInterface;

final class SubjectsController extends ControllerBase
{
    public function __construct(private SubjectsService $subjectsService)
    { }

    #[Route('/subjects', name: 'subjects_index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $filter = new FilterDto();
        $filterForm = $this->createForm(SubjectFilterType::class, $filter);
        $filterForm->handleRequest($request);

        $subjectsQb = $this->subjectsService->listWithFilter($filter);

        $subjects = $paginator->query($subjectsQb)
            ->perPage(self::PER_PAGE)
            ->paginate();

        return $this->render('subjects/index.html.twig', [
            'subjects' => $subjects,
            'filterForm' => $filterForm,
        ]);
    }

    #[Route('/subjects/new', name: 'subjects_new')]
    public function new(Request $request): Response
    {
        $newSubject = new SubjectDto();
        $createForm = $this->createForm(CreateSubjectType::class, $newSubject);

        if ($request->isMethod('POST')) {
            try {
                $createForm->handleRequest($request);

                $subject = $this->subjectsService->create($newSubject);

                $this->addFlash('success', 'Assunto criado com sucesso.');

                return $this->redirectToRoute('subjects_show', ['id' => $subject->id]);
            } catch (SubjectHandleException $e) {
                $this->addFlash('error', $e->getMessage());
            } catch (Exception $e) {
                $this->addFlash('error', 'Erro interno ao salvar um assunto.');
            }
        }

        return $this->render('subjects/new.html.twig', [
            'createForm' => $createForm
        ]);
    }

    #[Route('/subjects/{id}', name: 'subjects_show', requirements: ['page' => '[0-9]+'])]
    public function show(int $id): Response
    {
        try {
            $subjectDto = $this->subjectsService->getOne($id);
            return $this->render('subjects/show.html.twig', [
                'subject' => $subjectDto
            ]);
        } catch (SubjectHandleException $e) {
            $this->addFlash('error', $e->getMessage());
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao recuperar o assunto.');
        }

        return $this->redirectToRoute('subjects_index');
    }

    #[Route('/subjects/{id}/edit', name: 'subjects_edit', methods: ['GET', 'PUT'])]
    public function edit(Request $request, int $id): Response
    {
        try {
            $subjectEdit = $this->subjectsService->getOne($id);
            $editForm = $this->createForm(EditSubjectType::class, $subjectEdit);

            if ($request->isMethod('PUT')) {
                $editForm->handleRequest($request);

                $subject = $this->subjectsService->update($subjectEdit);

                $this->addFlash('success', 'Assunto editado com sucesso.');

                return $this->redirectToRoute('subjects_show', ['id' => $subject->id]);
            }

            return $this->render('subjects/edit.html.twig', [
                'editForm' => $editForm,
                'subject' => $subjectEdit,
            ]);
        } catch (SubjectHandleException $e) {
            $this->addFlash('error', $e->getMessage());
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao atualizar um assunto.');
        }

        return $this->redirectToRoute('subjects_index');
    }

    #[Route('/subjects/{id}/delete', name: 'subjects_delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        try {
            $this->subjectsService->delete($id);
            $this->addFlash('success', "Registro #{$id} excluído com sucesso.");
        } catch (NotFoundHttpException $e) {
            $this->addFlash('warning', $e->getMessage());
        } catch (Exception $e) {
            $this->addFlash('error', 'Erro interno ao excluir o assunto.');
        }
        return $this->redirectToRoute('subjects_index');
    }
}
