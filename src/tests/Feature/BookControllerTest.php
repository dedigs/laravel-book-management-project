<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_book_list()
    {
        factory(Book::class)->create(['title' => 'Test Book', 'author' => 'Test Author']);
        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Book');
        $response->assertSee('Test Author');
    }

    /** @test */
    public function it_can_create_a_book()
    {
        $this->withoutMiddleware();

        $response = $this->post(route('books.store'), [
            'title' => 'New Book',
            'author' => 'Danil',
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'New Book',
            'author' => 'Danil',
        ]);

        $response->assertRedirect(route('books.index'));
    }
}
