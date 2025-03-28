<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Pessoa;

class PessoaControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_index_exists()
    {
        $response = $this->get('/pessoas');
        $response->assertStatus(200);
    }

    public function test_index_shows_pessoas()
    {
        $pessoa = Pessoa::create([
            'nome' => 'Luiz',
            'idade' => 25
        ]);

        $response = $this->get(route('pessoas.index'));

        $response->assertStatus(200);
        $response->assertSee($pessoa->nome);
        $response->assertSee($pessoa->idade);
    }


    public function test_find_pessoa()
    {
        $pessoa = Pessoa::create([
            'nome' => 'Luiz',
            'idade' => 25
        ]);

        $response = $this->get(route('pessoas.show', $pessoa->id));

        $response->assertStatus(200);

        $response->assertSee($pessoa->nome);
        $response->assertSee($pessoa->idade);

        $this->assertDatabaseHas('pessoas', [
            'id' => $pessoa->id,
            'nome' => $pessoa->nome,
            'idade' => $pessoa->idade
        ]);
    }

    public function test_find_pessoa_not_found()
    {
        $response = $this->get(route('pessoas.show', 9999));
        $response->assertStatus(404);
    }


    public function test_create_pessoa()
    {
        $response = $this->post(route('pessoas.store'), [
            'nome' => 'Luiz',
            'idade' => 25
        ]);

        $this->assertCount(1, Pessoa::all());
        $response->assertRedirect(route('pessoas.index'));
    }

    public function test_create_pessoa_validation()
    {
        $response = $this->post(route('pessoas.store'), [
            'nome' => '', 
            'idade' => '' 
        ]);

        $response->assertSessionHasErrors(['nome', 'idade']);
    }


    public function test_update_pessoa()
    {
        $pessoa = Pessoa::create([
            'nome' => 'Luiz',
            'idade' => 25
        ]);

        $updateData = [
            'nome' => 'João',
            'idade' => 30
        ];

        $response = $this->put(route('pessoas.update', $pessoa->id), $updateData);
        $response->assertRedirect(route('pessoas.index'));

        $pessoaAtualizada = Pessoa::findOrFail($pessoa->id);

        $this->assertEquals('João', $pessoaAtualizada->nome);
        $this->assertEquals(30, $pessoaAtualizada->idade);

    }

    public function test_update_pessoa_validation()
    {
        $pessoa = Pessoa::create([
            'nome' => 'Luiz',
            'idade' => 25
        ]);

        $updateData = [
            'nome' => '',
            'idade' => 'invalid'
        ];

        $response = $this->put(route('pessoas.update', $pessoa->id), $updateData);
        $response->assertSessionHasErrors(['nome', 'idade']);
    }


    public function test_delete_pessoa()
    {
        $pessoa = Pessoa::create([
            'nome' => 'Luiz',
            'idade' => 25
        ]);

        $response = $this->delete(route('pessoas.delete', $pessoa->id));
        $response->assertRedirect(route('pessoas.index'));
        $this->assertDatabaseMissing('pessoas', [
            'id' => $pessoa->id
        ]);
    }



}
