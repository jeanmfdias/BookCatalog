<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\TestDox;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SubjectsControllerTest extends WebTestCase
{
    #[TestDox('Testando a listagem de assuntos')]
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/subjects');

        self::assertResponseIsSuccessful();
    }

    #[TestDox('Testando a visualização de um assunto e checando se está na página correta')]
    public function testShow(): void
    {
        $client = static::createClient();
        $client->request('GET', '/subjects/1');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Assunto #1');
    }

    #[TestDox('Testando a página de criar novo assunto')]
    public function testNew(): void
    {
        $client = static::createClient();
        $client->request('GET', '/subjects/new');

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('h1', 'Novo Assunto');
    }

    #[TestDox('Testando a página de editar um assunto')]
    public function testEdit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/subjects/1/edit');

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('h1', 'Editar Assunto #1');
    }

    #[TestDox('Testando a funcionalidade de deletar um assunto')]
    public function testDelete(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/subjects/1/delete');

        self::assertResponseRedirects('/subjects');

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Registro #1 excluído com sucesso');
    }

    #[TestDox('Testando a funcionalidade de salvar um assunto e verificando se foi criado')]
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/subjects/new');

        $client->submitForm('Salvar', [
            'create_subject[description]' => 'Teste 1'
        ]);

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Teste 1');
    }

    #[TestDox('Testando a funcionalidade de editar um assunto e verificando se foi editado')]
    public function testUpdate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/subjects/1/edit');

        $client->submitForm('Editar', [
            'edit_subject[description]' => 'Teste 2'
        ]);

        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertAnySelectorTextContains('p', 'Teste 2');
    }
}
