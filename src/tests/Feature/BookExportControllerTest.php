<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookExportControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_export_books_to_csv()
    {
        factory(Book::class)->create(['title' => 'Book 1', 'author' => 'Author 1']);
        factory(Book::class)->create(['title' => 'Book 2', 'author' => 'Author 2']);

        $response = $this->get(route('books.export.csv', ['type' => 'all']));

        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->assertHeader('Content-Disposition', 'attachment; filename=books_all.csv');

        $content = $response->streamedContent();

        $this->assertStringContainsString('title,author', $content);
        $this->assertStringContainsString('Book 1,Author 1', $content);
        $this->assertStringContainsString('Book 2,Author 2', $content);
    }

    /** @test */
    public function it_can_export_books_titles_to_csv()
    {
        factory(Book::class)->create(['title' => 'Book 1', 'author' => 'Author 1']);
        factory(Book::class)->create(['title' => 'Book 2', 'author' => 'Author 2']);

        $response = $this->get(route('books.export.csv', ['type' => 'titles']));

        $content = $response->streamedContent();

        $this->assertStringContainsString('title', $content);
        $this->assertStringContainsString('Book 1', $content);
        $this->assertStringContainsString('Book 2', $content);
        $this->assertStringNotContainsString('Author 1', $content);
    }

    /** @test */
    public function it_can_export_books_to_xml()
    {
        factory(Book::class)->create(['title' => 'Book 1', 'author' => 'Author 1']);
        factory(Book::class)->create(['title' => 'Book 2', 'author' => 'Author 2']);

        $response = $this->get(route('books.export.xml', ['type' => 'all']));

        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertHeader('Content-Disposition', 'attachment; filename=books_all.xml');

        $response->assertSee('<books>');
        $response->assertSee('<book>');
        $response->assertSee('<title>Book 1</title>');
        $response->assertSee('<author>Author 2</author>');
    }

    /** @test */
    public function it_can_export_books_authors_to_xml()
    {
        factory(Book::class)->create(['title' => 'Book 1', 'author' => 'Author 1']);
        factory(Book::class)->create(['title' => 'Book 2', 'author' => 'Author 2']);

        $response = $this->get(route('books.export.xml', ['type' => 'authors']));

        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertHeader('Content-Disposition', 'attachment; filename=books_authors.xml');

        $response->assertSee('<books>');
        $response->assertSee('<book>');
        $response->assertSee('<author>Author 1</author>');
        $response->assertDontSee('<book>Book 1</book>');
    }
}
