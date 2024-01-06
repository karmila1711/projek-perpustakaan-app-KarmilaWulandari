<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::select(
            'books.id',
            'book_name',
            'authors.author_id',
            'authors.author_name',
            'published_at',
        )
            ->leftJoin('authors', 'books.author_id', '=', 'authors.author_id')
            ->get()
            ->toArray();

        return new BooksResource(true, 'List Data Books', $books);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_name' => 'required',
            'author_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Books::create([
            'book_name' => $request->book_name,
            'author_id' => $request->author_id,
        ]);

        if ($book) {
            return new BooksResource(true, 'book Books Berhasil Disimpan!', $book);
        }

        return new BooksResource(false, 'Data Books Gagal Disimpan!', null);
    }


    public function update(Request $request, Books $book)
    {
        $validator = Validator::make($request->all(), [
            'book_name' => 'required',
            'author_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book->update([
            'book_name' => $request->book_name,
            'author_id' => $request->author_id,
        ]);

        if ($book) {
            return new BooksResource(true, 'book Books Berhasil Diupdate!', $book);
        }

        return new BooksResource(false, 'Data Books Gagal Diupdate!', null);
    }

    public function destroy(Books $book)
    {

        if ($book->delete()) {
            //return success with Api Resource
            return new BooksResource(true, 'Data book Berhasil Dihapus!', null);
        }

        //return failed with Api Resource
        return new BooksResource(false, 'Data book Gagal Dihapus!', null);
    }
}
