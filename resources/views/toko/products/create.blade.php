@extends('toko.layouts.master')

@section('content')

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">

            @if(session('status_success'))
                <div class="alert alert-success" role="alert">
                    {{ session('status_success') }}
                </div>                
            @endif
            <div class="col-lg-12">
                <h1>Membuat Produk Baru</h1>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            <form action="{{ route('product.store') }}" method="post" class="col-lg-8">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Produk..">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Produk</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Deskripsi Produk.."></textarea>
                </div>
                <div class="mb-3">
                    <label for="url_image" class="form-label">URL Gambar Produk</label>
                    <input type="text" class="form-control" id="url_image" name="url_image" placeholder="URL Gambar Produk..">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Harga Produk.." required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Kategori Produk</label>      

                    <select class="select2 form-control" name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>              
                   
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Produk</label>                    
                    <select class="form-select" name="status" aria-label="Default select example">
                        
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>

                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </div>
            </form>

        </div>
    </div>
</section>

@endsection
