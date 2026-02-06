<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('admin.books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book->load('category');
        return view('admin.books.show', compact('book'));
    }

    
    public function create()
{
    $categories = Category::all();
    return view('admin.books.create', compact('categories'));
}

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'publisher' => 'required',
        'year' => 'required|numeric',
        'stock' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('books', 'public');
    }

    Book::create($data);

    return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan');
}


    public function edit(Book $book)
{
    $categories = Category::all();
    return view('admin.books.edit', compact('book', 'categories'));
}


    public function update(Request $request, Book $book)
{
    $data = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'publisher' => 'required',
        'year' => 'required|numeric',
        'stock' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('books', 'public');
    }

    $book->update($data);

    return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diupdate');
}


    public function destroy(Book $book)
    {
        // hapus gambar
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect('/admin/books')->with('success', 'Buku berhasil dihapus');
    }


}
