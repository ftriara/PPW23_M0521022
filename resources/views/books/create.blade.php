@extends('layouts.main')

@section('container-fluid')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Tambah Data</h1>
                    </div>
                    <form method="post" action="/books" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="Kode Buku" required value="{{ old('kode_buku') }}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required value="{{ old('judul') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" required value="{{ old('penulis') }}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" required value="{{ old('penerbit') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Tahun Terbit" min="1900" max="2900" required value="{{ old('tahun_terbit') }}">
                            </div>
                            <div class="col-sm-6">
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                <input type="file" class="form-control" id="cover" name="cover" onchange="previewImage()">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary mt-3" name="submit" type="submit">Tambahkan</button>
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