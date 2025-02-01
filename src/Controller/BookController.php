<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[ Route( '/api/books', name: 'api_books_' ) ]

class BookController extends AbstractController {
    #[ Route( '', methods: [ 'GET' ] ) ]

    public function getAllBooks( EntityManagerInterface $entityManager, SerializerInterface $serializer ): JsonResponse {
        $books = $entityManager->getRepository( Book::class )->findAll();
        return new JsonResponse( $serializer->serialize( $books, 'json' ), JsonResponse::HTTP_OK, [], true );
    }

    #[ Route( '/{id}', methods: [ 'GET' ] ) ]

    public function getBookById( int $id, EntityManagerInterface $entityManager, SerializerInterface $serializer ): JsonResponse {
        $book = $entityManager->getRepository( Book::class )->find( $id );
        if ( !$book ) {
            return new JsonResponse( [ 'message' => 'Livro não encontrado' ], JsonResponse::HTTP_NOT_FOUND );
        }
        return new JsonResponse( $serializer->serialize( $book, 'json' ), JsonResponse::HTTP_OK, [], true );
    }

    #[ Route( '', methods: [ 'POST' ] ) ]

    public function createBook( Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer ): JsonResponse {
        $data = json_decode( $request->getContent(), true );
        if ( !isset( $data[ 'title' ], $data[ 'author' ], $data[ 'year' ] ) ) {
            return new JsonResponse( [ 'message' => 'Dados inválidos' ], JsonResponse::HTTP_BAD_REQUEST );
        }

        $book = new Book();
        $book->setTitle( $data[ 'title' ] );
        $book->setAuthor( $data[ 'author' ] );
        $book->setDescription( $data[ 'description' ] ?? null );
        $book->setYear( $data[ 'year' ] );

        $entityManager->persist( $book );
        $entityManager->flush();

        return new JsonResponse( $serializer->serialize( $book, 'json' ), JsonResponse::HTTP_CREATED, [], true );
    }

    #[ Route( '/{id}', methods: [ 'PUT' ] ) ]

    public function updateBook( int $id, Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer ): JsonResponse {
        $book = $entityManager->getRepository( Book::class )->find( $id );
        if ( !$book ) {
            return new JsonResponse( [ 'message' => 'Livro não encontrado' ], JsonResponse::HTTP_NOT_FOUND );
        }

        $data = json_decode( $request->getContent(), true );
        if ( isset( $data[ 'title' ] ) ) {
            $book->setTitle( $data[ 'title' ] );
        }
        if ( isset( $data[ 'author' ] ) ) {
            $book->setAuthor( $data[ 'author' ] );
        }
        if ( isset( $data[ 'description' ] ) ) {
            $book->setDescription( $data[ 'description' ] );
        }
        if ( isset( $data[ 'year' ] ) ) {
            $book->setYear( $data[ 'year' ] );
        }

        $entityManager->flush();

        return new JsonResponse( $serializer->serialize( $book, 'json' ), JsonResponse::HTTP_OK, [], true );
    }

    #[ Route( '/{id}', methods: [ 'DELETE' ] ) ]

    public function deleteBook( int $id, EntityManagerInterface $entityManager ): JsonResponse {
        $book = $entityManager->getRepository( Book::class )->find( $id );
        if ( !$book ) {
            return new JsonResponse( [ 'message' => 'Livro não encontrado' ], JsonResponse::HTTP_NOT_FOUND );
        }

        $entityManager->remove( $book );
        $entityManager->flush();

        return new JsonResponse( [ 'message' => 'Livro deletado com sucesso' ], JsonResponse::HTTP_OK );
    }

}

?>