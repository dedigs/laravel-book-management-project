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
            fwrite($file, implode(',', array_keys($books[0] ?? [])) . "\n");
            foreach ($books as $row) {
                fwrite($file, implode(',', $row) . "\n");
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportXml($type)
    {
        $books = $this->getBooksData($type);

        $fileName = "books_{$type}.xml";
        $headers = [
            "Content-Type" => "application/xml",
            "Content-Disposition" => "attachment; filename=$fileName"
        ];

        $xml = new \SimpleXMLElement('<books/>');
        foreach ($books as $book) {
            $bookNode = $xml->addChild('book');
            foreach ($book as $key => $value) {
                $bookNode->addChild($key, htmlspecialchars($value));
            }
        };

        return Response::make($xml->asXML(), 200, $headers);
    }

    private function getBooksData($type)
    {
        $booksQuery = Book::query();

        switch ($type) {
            case 'titles':
                return $booksQuery->pluck('title')->map(fn($title) => compact('title'))->toArray();
            case 'authors':
                return $booksQuery->pluck('author')->map(fn($author) => compact('author'))->toArray();
            default:
                return $booksQuery->select('title', 'author')->get()->toArray();
        }
    }
}

