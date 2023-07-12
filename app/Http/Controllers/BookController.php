<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index', [
            'title' => 'Data Buku',
            'books' => Book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin');
        return view('books.create', [
            'title' => 'Tambah Data',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin');
        $validatedData = $request->validate([
            'kode_buku' => 'required| string',
            'judul' => 'required| string',
            'penulis' => 'required| string',
            'penerbit' => 'required| string',
            'tahun_terbit' => 'required| digits:4| integer| min:1900| max:2900',
            'cover' => 'nullable| image| file| mimes:jpeg,png,jpg,gif,svg| max:2048',
        ]);

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('cover');
        }

        Book::create($validatedData);

        return redirect('/books')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', [
            'title' => 'Detail Buku',
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $this->authorize('admin');
        return view('books.edit', [
            'title' => 'Edit Data',
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize('admin');
        $validatedData = $request->validate([
            'kode_buku' => 'required| string',
            'judul' => 'required| string',
            'penulis' => 'required| string',
            'penerbit' => 'required| string',
            'tahun_terbit' => 'required| digits:4| integer| min:1900| max:2900',
            'cover' => 'nullable| image| file| mimes:jpeg,png,jpg,gif,svg| max:2048',
        ]);

        if ($request->file('cover')) {
            if($request->oldCover) {
                Storage::delete($request->oldCover);
            }
            $validatedData['cover'] = $request->file('cover')->store('cover');
        }

        Book::where('id', $book->id)
            ->update($validatedData);

        return redirect('/books')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->authorize('admin');
        if($book->cover) {
            Storage::delete($book->cover);
        }

        Book::destroy($book->id);

        return redirect('/books')->with('success', 'Data berhasil dihapus!');
    }
}
