<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\TestDox;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuthorsControllerTest extends WebTestCase
{
    #[TestDox('Testando listagem de autores')]
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/authors');

        self::assertResponseIsSuccessful();
    }

    #[TestDox('Testando a visualização de um autor e checando se está na página correta')]
    public function testShow(): void
    {
        $client = static::createClient();
        $client->request('GET', '/authors/1');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Autor #1');
    }

    #[TestDox('Testando a página de criar novo autor')]
    public function testNew(): void
    {
        $client = static::createClient();
        $client->request('GET', '/authors/new');

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('h1', 'Novo Autor');
    }

    #[TestDox('Testando a página de editar um autor')]
    public function testEdit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/authors/1/edit');

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('h1', 'Editar Autor #1');
    }

    #[TestDox('Testando a funcionalidade de deletar um autor')]
    public function testDelete(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/authors/1/delete');

        self::assertResponseRedirects('/authors');

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Registro #1 excluído com sucesso');
    }

    #[TestDox('Testando a funcionalidade de salvar um autor e verificando se foi criado')]
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/authors/new');

        $client->submitForm('Salvar', [
            'author_create[name]' => 'Teste Autor 1'
        ]);

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Teste Autor 1');
    }

    #[TestDox('Testando a funcionalidade de editar um autor e verificando se foi editado')]
    public function testUpdate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/authors/1/edit');

        $client->submitForm('Editar', [
            'author_edit[name]' => 'Teste Autor 2'
        ]);

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Teste Autor 2');
    }
}
