<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookExportController extends Controller
{
    public function exportCsv($type)
    {
        $books = $this->getBooksData($type);

        $fileName = "books_{$type}.csv";
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName"
        ];

        $callback = function() use ($books) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array_keys($books[0] ?? []));

            foreach ($books as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getBooksData($type)
    {
        $booksQuery = Book::query();

        switch ($type) {
            case 'titles':
                return $booksQuery->pluck('title')->map(fn($title) => ['title' => $title])->toArray();
            case 'authors':
                return $booksQuery->pluck('author')->map(fn($author) => ['author' => $author])->toArray();
            default:
                return $booksQuery->select('title', 'author')->get()->toArray();
        }
    }
}

