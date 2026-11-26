<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\TestDox;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BooksControllerTest extends WebTestCase
{
    #[TestDox('Testando a listagem de livros')]
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/books');

        self::assertResponseIsSuccessful();
    }

    #[TestDox('Testando a visualização de um livro e checando se está na página correta')]
    public function testShow(): void
    {
        $client = static::createClient();
        $client->request('GET', '/books/1');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Livro #1');
    }

    #[TestDox('Testando a página de criar novo livro')]
    public function testNew(): void
    {
        $client = static::createClient();
        $client->request('GET', '/books/new');

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('h1', 'Novo Livro');
    }

    #[TestDox('Testando a página de editar um livro')]
    public function testEdit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/books/1/edit');

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('h1', 'Editar Livro #1');
    }

    #[TestDox('Testando a funcionalidade de deletar um livro')]
    public function testDelete(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/books/1/delete');

        self::assertResponseRedirects('/books');

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Registro #1 excluído com sucesso');
    }

    #[TestDox('Testando a funcionalidade de salvar um livro e verificando se foi criado')]
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/books/new');

        $client->submitForm('Salvar', [
            'book_create[title]' => 'Teste Livro 1',
            'book_create[publisher]' => 'Editora X',
            'book_create[published_year]' => '2000',
            'book_create[edition]' => 1,
            'book_create[price]' => 10,
            'book_create[isbn]' => 10,
        ]);

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Teste Livro 1');
    }

    #[TestDox('Testando a funcionalidade de editar um livro e verificando se foi editado')]
    public function testUpdate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/books/1/edit');

        $client->submitForm('Editar', [
            'book_edit[title]' => 'Teste Livro 2',
            'book_edit[isbn]' => 'Teste Livro 2'
        ]);

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Teste Livro 2');
    }
}
