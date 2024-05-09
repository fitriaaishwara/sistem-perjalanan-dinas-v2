@extends('pages.layouts.master')
@section('content')
@section('title', 'Sistem Perjalanan Dinas - Profile')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Profile</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">My Profile</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Profile</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <form method="POST" action="{{ url('profile/update/'.$user->id) }}" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group form-show-validation row">
                                <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Name <span class="required-label">*</span></label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" value="{{ Auth::user()->name }}" required>
                                </div>
                            </div>
                            <div class="form-group form-show-validation row">
                                <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Username <span class="required-label">*</span></label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="username" aria-label="username" aria-describedby="username-addon" id="username" name="username" value="{{ Auth::user()->username }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-show-validation row">
                                <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Email Address</label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ Auth::user()->email }}">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                            </div>
                            <div class="form-group form-show-validation row">
                                <label for="password" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Password</label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-group form-show-validation row">
                                <label for="confirmpassword" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Confirm Password</label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="separator-solid"></div>
                            <div class="form-group form-show-validation row">
                                <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Upload Image</label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <div class="input-file input-file-image">
                                        <img class="img-upload-preview img-circle" width="100" height="100" src="{{ Auth::user()->photo != '' ? asset('storage/images/profile/' . Auth::user()->photo) : asset('assets/img/profile/kemenkop.png') }}" alt="preview">
                                        <input type="file" class="form-control form-control-file" id="photo" name="photo" >
                                        <label for="photo" class="btn btn-primary btn-round btn-lg"><i class="fa fa-file-image"></i> Upload a Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="btn btn-success" type="submit" value="Validate">
                                    <button class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('js')


@endpush







