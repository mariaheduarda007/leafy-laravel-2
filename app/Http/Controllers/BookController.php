<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{

    public function index(Request $request)
    {
        Gate::authorize('viewAny', Book::class);
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('genre', 'like', "%{$search}%")
                ->orWhere('releaseDate', 'like', "%{$search}%");
        }

        $books = $query->paginate(10)->withQueryString();

        return view('book.index', compact('books'));
    }

    public function create()
    {
        Gate::authorize('create', Book::class);

        return view('book.create');
    }
    public function store(Request $request)
    {
        Gate::authorize('create', Book::class);

        $book = new Book();
        $book->title = $request->title;
        $book->releaseDate = $request->releaseDate;
        $book->genre = $request->genre;
        $book->author = $request->author;
        $book->sinopsis = $request->sinopsis;
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
            $book->title = $request->title;
            $book->releaseDate = $request->releaseDate;
            $book->author = $request->author;
            $book->genre = $request->genre;
            $book->sinopsis = $request->sinopsis;

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
        Gate::authorize('viewAny', Book::class);

        $books = Book::all();
        $pdf = Pdf::loadView('report', ['books' => $books]);

        return $pdf->stream('document.pdf');
    }
}
