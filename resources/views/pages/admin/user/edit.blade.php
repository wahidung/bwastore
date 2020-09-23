@extends('layouts.admin')

@section('title','Admin User Store')

@section('content')
<div id="page-content-wrapper">
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">User</h2>
                <p class="dashboard-subtitle">
                    Edit User
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
                                <form action="{{ route('user.update',$item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama User</label>
                                        <input type="text" class="form-control" name="name" value="{{ $item->name }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email User</label>
                                        <input type="email" class="form-control" name="email" value="{{ $item->email }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                        <small>Kosongkan jika tidak ingin mengganti password</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Roles</label>
                                        <select class="form-control" name="roles" required>
                                            <option value="ADMIN" {{ ($item->roles == 'ADMIN' ? 'selected' : '') }}>
                                                Admin</option>
                                            <option value="USER" {{ ($item->roles == 'USER' ? 'selected' : '') }}>User
                                            </option>
                                        </select>
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