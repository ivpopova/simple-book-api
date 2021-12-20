<?php

namespace App\Http\Controllers;


use App\Book;
use App\User;
use Image;
use App\Http\Resources\Book as BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->with('author')->paginate();
        return view('home', [
            "books"=> $books
        ]);
    }

    public function show(Book $book)
    {
        return \App\Http\Resources\Book::make($book->load('author'));
    }

    public function create()
    {
        $authors = User::where(function($query) {
            $query->where('is_author','1');
        })->get();

        return view('books.create', [
            'authors' => $authors,
        ]);
    }

    public function store(Request $request)
    {
        /*$data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'author_id' => 'exists:users,id',
            'cover' => 'required|image|mimes:jpeg,png',
        ]); */

        $book= new Book;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author_id;

        if($request->hasfile('cover'))
        {
          $image = $request->file('cover');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          Image::make($image)->resize(300, 300)->save(storage_path('/uploads/' . $filename ) );
          $book->cover = $filename;
        }

        $book->save();
        return redirect()->back()->with('message','Book is published successfully!');
        //return \App\Http\Resources\Book::make(Book::create($data));
    }

    public function destroy(Book $book)
    {
        return response()->json([
            'status' => $book->delete()
        ], 200);
    }
}
