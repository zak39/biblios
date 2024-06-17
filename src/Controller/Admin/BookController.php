<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\User;
use App\Form\BookType;
use Pagerfanta\Pagerfanta;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/book')]
class BookController extends AbstractController
{
    
    #[Route('', name: 'app_admin_book_index')]
    public function index(?BookRepository $repository, Request $request): Response
    {
        $books = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($repository->findAllWithPaginator()),
            $request->query->get('page', 1),
            6
        );

        return $this->render('admin/book/index.html.twig', [
            'books' => $books
        ]);
    }

    #[Route('/{id}', name: 'app_admin_book_show', requirements: [ 'id' => '\d+' ], methods: ['GET'])]
    public function show(?Book $book): Response
    {
        return $this->render('admin/book/show.html.twig', [
            'book' => $book
        ]);
    }

    #[IsGranted('ROLE_AJOUT_DE_LIVRE')]
    #[Route('/new', name: 'app_admin_book_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/edit', name: 'app_admin_book_edit', requirements: ['id' => '\d+'],methods: ['GET', 'POST'])]
    public function new(?Book $book, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($book) {
            $this->denyAccessUnlessGranted('ROLE_EDITION_DE_LIVRE');
            // $this->denyAccessUnlessGranted('book.is_creator', $book);
        }

        $book ??= new Book();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();

            if (!$book->getId() && $user instanceof User) {
                $book->setCreatedBy($user);
            }
            
            // Faire quelque chose
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_book_index');
        }

        return $this->render('admin/book/new.html.twig', [
            'form' => $form,
        ]);
    }
}
