@extends('pages.layouts.master')
@section('content')
@section('title', 'Detail SPD')
<style>
    .container {
      overflow-x: auto;
      white-space: nowrap;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
</style>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Detail SPD</h4>
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
                    <a href="#">Surat Pre-Perjalanan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detail SPD</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lembar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Depan</td>
                                        <td>
                                            <a href="{{ route('spd/pdf', $spd->id) }}" class="btn btn-primary btn-sm">PDF</a>
                                            <a href="{{ route('export', $spd->id) }}" class="btn btn-success btn-sm">Excel</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Belakang</td>
                                        <td>
                                            <a href="{{ route('spd/pdf2', $spd->id) }}" class="btn btn-primary btn-sm">PDF</a>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>3</td>
                                        <td>Depan Xlsx</td>
                                        <td>
                                            <a href="{{ route('export', $spd->id) }}" class="btn btn-primary btn-sm">Download</a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
