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

    /** @test */
    public function it_can_delete_a_book()
    {
        $book = factory(Book::class)->create();

        $response = $this->delete(route('books.destroy', $book->id));

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
        $response->assertRedirect(route('books.index'));
    }

    /** @test */
    public function it_can_update_author_of_a_book()
    {
        $book = factory(Book::class)->create(['author' => 'Old Author']);

        $response = $this->put(route('books.updateAuthor', $book->id), [
            'author' => 'New Author',
        ]);

        $this->assertDatabaseHas('books', ['id' => $book->id, 'author' => 'New Author']);
        $response->assertRedirect(route('books.index'));
    }

    /** @test */
    public function it_can_sort_books()
    {
        factory(Book::class)->create(['title' => 'B Title']);
        factory(Book::class)->create(['title' => 'A Title']);

        $response = $this->get(route('books.sort', 'title'));

        $response->assertSeeInOrder(['A Title', 'B Title']);
    }

    /** @test */
    public function it_can_search_books_by_title()
    {
        factory(Book::class)->create(['title' => 'Unique Title', 'author' => 'Search Author']);
        factory(Book::class)->create(['title' => 'Another Book', 'author' => 'Another Author']);

        $response = $this->get(route('books.search', ['query' => 'Unique']));

        $response->assertSee('Unique Title');
        $response->assertSee('Search Author');
        $response->assertDontSee('Another Book');
    }

    /** @test */
    public function it_can_search_books_by_author()
    {
        factory(Book::class)->create(['title' => 'Unique Title', 'author' => 'Search Author']);
        factory(Book::class)->create(['title' => 'Another Book', 'author' => 'Another Author']);

        $response = $this->get(route('books.search', ['query' => 'Search']));

        $response->assertSee('Unique Title');
        $response->assertSee('Search Author');
        $response->assertDontSee('Another Book');
    }
}
