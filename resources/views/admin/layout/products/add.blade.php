@extends('admin.dashboard')
@section('content')
<div class="container">
    <br>
    <center>
        <h3>Tambahkan Produk</h3>
    </center>
    <br>
    <div class="container">
        <a href="/admin/product/index" class="btn btn-sm btn-cokelat text-capitalize" >back</a>
        <br>
    </div>
    <br>
    <form enctype="multipart/form-data" action="/admin/backend/product/store" method="POST">
        @csrf
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" placeholder="Nama produk :" name="product" id="product" class="col form-control form-control-sm">
                </div>
                <div class="col">
                    <input type="text" placeholder="Harga Produk :" name="price" id="product" class="col form-control form-control-sm">
                </div>
            </div>
            <div class="col mb-3">
                <select name="category" id="category" class="form-control form-control-sm">
                    <option selected disabeld hidden>Pilih Kategori Produk :</option>
                    <option value="Coffee">Coffee</option>
                    <option value="Susu">Susu</option>
                    <option value="Tea">Tea</option>
                </select>
            </div>
            <div class="col mb-3">
                <input type="text" class="form-control form-control-sm" id="file" name="image" onfocus = "this.type='file'" placeholder="Foto Produk :">
            </div>
            <div class="col mb-3">
                <select name="status" id="status" class="form-control form-control-sm">
                    <option selected disabeld hidden>Pilih status produk :</option>
                    <option value="open">Ready</option>
                    <option value="closed">Habis</option>
                </select>
            </div>
            <div class="col mb-3">
                <textarea name="description" id="description" class="form-control form-control-sm" placeholder="Deskripsi Produk :"></textarea>
            </div>
            <div class="col">
                <button class="btn btn-lg btn-cokelat w-100">Submit</button>
            </div>
        </div>
    </form>
</div>
@stop