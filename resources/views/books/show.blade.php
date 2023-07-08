@extends('layouts.main')

@section('container-fluid')
    <h1 class="mb-5">{{ $book->judul }}</h1>

    @if ($book->cover)
        <div style="max-height: 400px; overflow: auto;">
            <img src="{{ asset('storage/' . $book->cover) }}" alt="">
        </div>
    @endif
    
    <br>
    <h6>Kode Buku    : {{ $book->kode_buku }}</h6>
    <h6>Penulis      : {{ $book->penulis }}</h6>
    <h6>Penerbit     : {{ $book->penerbit }}</h6>
    <h6>Tahun Terbit : {{ $book->tahun_terbit }}</h6>

    <br><br>
    <a href="/books">Back to list</a>
@endsection