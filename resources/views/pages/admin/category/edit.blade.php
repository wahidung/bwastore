@extends('layouts.admin')

@section('title','Admin Category Store')

@section('content')
<div id="page-content-wrapper">
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">
                    Edit Category
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
                                <form action="{{ route('category.update',$item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" class="form-control" name="name" value="{{ $item->name }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <img src="{{ Storage::url($item->photo) }}" class="d-block mb-3"
                                            style="max-width:100px;">
                                        <input type="file" class="form-control" name="photo">
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