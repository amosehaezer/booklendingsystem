<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')->get();
        return view('book.index', ['books' => $books]);
    }
    public function create()
    {
        return view('book.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'author'=>'required',
            'price'=>'required'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->count = 0;
        
        $book->save();
        // return response()->json($book, 201);
        return response()->json(['success' => 'Add new book sucessfully!']);
        // return redirect('/book');
    }
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.update', compact('book'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required',
        ]);
        $book = Book::find($id);
        $book->title = $request->get('title');
        $book->author = $request->get('author');
        $book->price = $request->get('price');
        $book->save();
        // return redirect('/book')->with('success', 'Book updated!');
        return response()->json(['success' => 'Update book sucessfully!']);
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        // return redirect('/book')->with('success', 'Book deleted!');
        return response()->json(['success' => 'Book delete sucessfully!']);
    }
}
