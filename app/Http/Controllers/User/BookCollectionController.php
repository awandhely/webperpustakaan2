<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookCollectionController extends Controller
{
    public function index()
    {
        $collections = Auth::user()->collections()->with('category')->get();
        return view('user.collection.index', compact('collections'));
    }

    public function toggle(Book $book)
    {
        $user = Auth::user();
        
        if ($user->collections()->where('book_id', $book->id)->exists()) {
            $user->collections()->detach($book->id);
            $message = 'Buku dihapus dari koleksi.';
        } else {
            $user->collections()->attach($book->id);
            $message = 'Buku ditambahkan ke koleksi.';
        }

        return back()->with('success', $message);
    }
}
