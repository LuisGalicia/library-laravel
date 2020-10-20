<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.book');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name'=>'required',
            'author'=>'required',
            'published_date'=>'required',
            'available'=>'required',
            'category_id'=>'required',
        ]);

        Book::create([
            'name' => request('name'),
            'author' => request('author'),
            'published_date' => request('published_date'),
            'available' => request('available'),
            'category_id' => request('category_id'),
        ]);

        return redirect(route('book.show'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return Book::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update($id, Book $book)
    {
        Book::where('id', '=', $id)->update([
            'name' => request('name'),
            'author' => request('author'),
            'published_date' => request('published_date'),
            'category_id' => request('category_id')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
    }

    public function editUser($id) {
        Book::where('id', '=', $id)->update([
            'guest_id' => request('guest_id'),
            'available' => 2
        ]);
    }

    public function changeAvailable($id) {
        Book::where('id', '=', $id)->update([
            'available' => 1,
            'guest_id' => null
        ]);
    }
}
