@extends('layouts.main')

@section('container-fluid')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Edit Data</h1>
                    </div>
                    <form method="post" action="/books/{{ $book->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="Kode Buku" required value="{{ old('kode_buku', $book->kode_buku) }}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required value="{{ old('judul', $book->judul) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" required value="{{ old('penulis', $book->penulis) }}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" required value="{{ old('penerbit', $book->penerbit) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Tahun Terbit" min="1900" max="2900" required value="{{ old('tahun_terbit', $book->tahun_terbit) }}">
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="oldCover" id="oldCover" value="{{ $book->cover }}">
                                @if ($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                @else    
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input type="file" class="form-control" id="cover" name="cover" onchange="previewImage()">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary mt-3" name="submit" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const cover = document.querySelector('#cover');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(cover.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
    
@endsection