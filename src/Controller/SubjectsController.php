<?php

namespace App\Controller;

use App\DTO\Subject\FilterDto;
use App\Form\SubjectFilterType;
use App\Services\SubjectsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Pagination\PaginatorInterface;

final class SubjectsController extends AbstractController
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
            ->perPage(2)
            ->paginate();

        return $this->render('subjects/index.html.twig', [
            'subjects' => $subjects,
            'filterForm' => $filterForm,
        ]);
    }

    #[Route('/subjects/new', name: 'subjects_new')]
    public function new(): Response
    {
        return $this->render('subjects/new.html.twig');
    }

    #[Route('/subjects/show', name: 'subjects_show')]
    public function show(): Response
    {
        return $this->render('subjects/show.html.twig');
    }

    #[Route('/subjects/edit', name: 'subjects_edit')]
    public function edit(): Response
    {
        return $this->render('subjects/show.html.twig');
    }

    #[Route('/subjects/delete', name: 'subjects_delete')]
    public function delete(): Response
    {
        return $this->render('subjects/show.html.twig');
    }
}
