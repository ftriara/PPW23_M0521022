@extends('layouts.main')

@section('container-fluid')

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-10 mt-2 mx-auto" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
    </div>
    <div class="card-body">
        @can('admin')
        <div class="mt-2 mb-4">
            <a class="btn btn-primary" href="/books/create">
                <i class="fas fa-plus">&ensp;Tambah Data</i>
            </a>
        </div>
        @endcan
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Buku</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->kode_buku }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->penerbit }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>
                                <a class="btn btn-info" href="/books/{{ $book->id }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('admin')
                                <a class="btn btn-warning" href="/books/{{ $book->id }}/edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/books/{{ $book->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection