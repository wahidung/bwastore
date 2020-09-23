@extends('layouts.admin')

@section('title','Admin Product Store')

@section('content')
<div id="page-content-wrapper">
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">
                    Edit Product
                </p>
            </div>
            <div class="dashboard-content">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('product.update',$item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Product</label>
                                        <input type="text" class="form-control" name="name" value="{{ $item->name }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pemilik Product</label>
                                        <select name="users_id" id="" class="form-control" required>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ ($user->id == $item->users_id) ? 'selected' : ''}}>{{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Product</label>
                                        <select name="categories_id" id="" class="form-control" required>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ ($category->id == $item->categories_id) ? 'selected' : ''}}>
                                                {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Product</label>
                                        <input type="number" class="form-control" name="price"
                                            value="{{ $item->price }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Product</label>
                                        <textarea id="editor" name="description">{{ $item->description }}</textarea>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success px-5">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endpush