<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{

    public function index()
    {
        Gate::authorize('viewAny', Book::class);
        $books = Book::all();
        // dd($books);
        return view('book.index', compact('books'));
    }

    public function create()
    {
        Gate::authorize('create', Book::class);
        return view('book.create', );
    }
    public function store(Request $request)
    {
        Gate::authorize('create', Book::class);

        $book = new Book();
        $book->title = $request->title;
        $book->releaseDate = $request->releaseDate;
        $book->genre = $request->genre;
        $book->author = $request->author;
        $book->save();

        if ($request->hasFile('cover')) {
            $extensao_arq = $request->file('cover')->getClientOriginalExtension();
            $name = $book->id . '_' . time() . '.' . $extensao_arq;
            $request->file('cover')->storeAs('covers', $name, ['disk' => 'public']);
            $book->cover = 'covers/' . $name;
            $book->save();
        }


        return redirect()->route('book.index');
    }
    public function show(string $id)
    {
        Gate::authorize('view', Book::class);
    }
    public function edit(string $id)
    {
        $book = Book::find($id);
        Gate::authorize('update', $book);

        if (isset($book)) {
            return view('book.edit', compact('book'));
        }

        return redirect()->route('book.index');
    }
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        Gate::authorize('update', $book);

        if (isset($book)) {
            $book->title = mb_strtoupper($request->title, encoding: 'UTF-8');
            $book->releaseDate = $request->releaseDate;

            if ($request->hasFile('cover')) {
                $extensao_arq = $request->file('cover')->getClientOriginalExtension();
                $name = $book->id . '_' . time() . '.' . $extensao_arq;
                $request->file('cover')->storeAs('covers', $name, ['disk' => 'public']);
                $book->cover = 'covers/' . $name;
            }
            $book->save();
        }

        return redirect()->route('book.index');
    }
    public function destroy(string $id)
    {
        $book = Book::find($id);
        Gate::authorize('delete', $book);

        if (isset($book)) {
            $book->delete();
        }

        return redirect()->route('book.index');
    }

    public function report()
    {
        $books = Book::all();
        $pdf = Pdf::loadView('book.report', ['books' => $books]);
        return $pdf->stream('document.pdf');

    }
}
