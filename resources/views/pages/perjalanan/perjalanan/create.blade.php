@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Perjalanan')
            <div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Forms</h4>
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
								<a href="#">Forms</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Basic Form</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Form Pegawai</div>
								</div>
								<div class="card-body">
									<div class="col-lg-12">
                                        @foreach ( $user as $groupUser => $data)
                                        <div class="form-group">
											<label for="nip">NIP / NIPPPK / NIK</label>
											<input type="text" class="form-control" id="nip" name="nip" minlength="16" maxlength="16" value="{{ $data->nip }}" placeholder="NIP / NIPPPK / NIK">
										</div>
                                        <div class="form-group">
											<label for="name">Nama</label>
											<input type="text" class="form-control" id="name" name="name" placeholder="Nama Pegawai" value="{{ $data->name }}">
										</div>
                                            <div class="form-group">
											<label for="email2">Jabatan</label>
											<select class="form-control" id="exampleFormControlSelect1">
												<option></option>
												<option>2</option>
												<option>3</option>
											</select>
										</div>
                                            <div class="form-group">
											<label for="email2">Golongan</label>
											<select class="form-control" id="exampleFormControlSelect1">
												<option></option>
												<option>2</option>
												<option>3</option>
											</select>
										</div>
                                            <div class="form-group">
											<label for="email2">Instansi / Perusahaan</label>
											<input type="text" class="form-control" id="email2" placeholder="Nama Instansi/Perusahaan">
										</div>
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection





