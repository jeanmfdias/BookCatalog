<?php

namespace App\Controller;

use App\DTO\Subject\FilterDto;
use App\DTO\Subject\SubjectDto;
use App\Form\CreateSubjectType;
use App\Form\EditSubjectType;
use App\Form\SubjectFilterType;
use App\Services\SubjectsService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

                return $this->redirectToRoute('subjects_show', ['id' => $subject->id]);
            } catch (Exception $e) {
                $this->addFlash('error', 'Erro ao salvar');
            }
        }

        return $this->render('subjects/new.html.twig', [
            'createForm' => $createForm
        ]);
    }

    #[Route('/subjects/{id}', name: 'subjects_show', requirements: ['page' => '[0-9]+'])]
    public function show(int $id): Response
    {
        $subjectDto = $this->subjectsService->getOne($id);
        return $this->render('subjects/show.html.twig', [
            'subject' => $subjectDto
        ]);
    }

    #[Route('/subjects/{id}/edit', name: 'subjects_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id): Response
    {
        $subjectEdit = $this->subjectsService->getOne($id);
        $editForm = $this->createForm(EditSubjectType::class, $subjectEdit);

        if ($request->isMethod('POST')) {
            try {
                $editForm->handleRequest($request);

                $subject = $this->subjectsService->update($subjectEdit);
            } catch (Exception $e) {
                $this->addFlash('error', 'Erro ao atualizar');
            }

            return $this->redirectToRoute('subjects_show', ['id' => $subject->id]);
        }

        return $this->render('subjects/edit.html.twig', [
            'editForm' => $editForm,
            'subject' => $subjectEdit,
        ]);
    }

    #[Route('/subjects/{id}', name: 'subjects_delete', methods: 'DELETE')]
    public function delete(): Response
    {
        return $this->render('subjects/show.html.twig');
    }
}
