@extends('pages.layouts.master')
@section('content')
@section('title', 'Surat Perjalanan Dinas')
            <div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Form Surat Perjalanan Dinas</h4>
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
								<a href="#">Surat Perjalanan Dinas</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Form Surat Perjalanan Dinas</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <form action="{{ route('spd/store') }}" method="POST" id="pengajuanForm">
                                @csrf
                                <div class="card">
                                    <div id="myModal" class="card-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="nomor_spt">Nama/NIP Pegawai Yang Melaksanakan Perjalanan Dinas</label>
                                                <input type="text" class="form-control" value="{{ $dataStaff->staff->name }}" readonly validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Maksud Perjalanan Dinas</label>
                                                <input type="text" class="form-control" value=" {{ $dataStaff->perjalanan[0]->perihal_perjalanan }} " readonly validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Tempat Berangkat - Tempat Tujuan</label>
                                                <input type="text" class="form-control"  value="{{ $dataStaff->tujuan_perjalanan[0]->tempat_berangkat }} - {{ $dataStaff->tujuan_perjalanan[0]->tempat_tujuan }}" readonly validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Tanggal Berangkat - Tanggal Tujuan</label>
                                                <input type="text" class="form-control"  value="{{ tgl_indo($dataStaff->tujuan_perjalanan[0]->tanggal_berangkat) }} - {{ tgl_indo($dataStaff->tujuan_perjalanan[0]->tanggal_pulang) }}" readonly validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Lama Perjalanan Dinas</label>
                                                <input type="text" class="form-control" value="{{ $dataStaff->tujuan_perjalanan[0]->lama_perjalanan }}" readonly validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Instansi</label>

                                                @if($dataStaff->staff->instansis == true)
                                                    <input type="text" class="form-control" value="{{ $dataStaff->staff->instansis->name }}" readonly validate>
                                                @else
                                                    <input type="text" class="form-control" value="-" readonly validate>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Akun</label>
                                                <input type="text" class="form-control"  placeholder="Nomor Surat Perjalanan Dinas" value="{{ $dataStaff->perjalanan[0]->mak->kode_mak }}" readonly validate>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Surat Perjalanan Dinas</div>
                                    </div>
                                    <div id="myModal" class="card-body">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="id_staff_perjalanan" id="id_staff_perjalanan" value="{{ $dataStaff->id }}">
                                            <div class="form-group">
                                                <label for="nomor_spt">Nomor SPD</label>
                                                <input type="text" name="nomor_spd" id="nomor_spd" class="form-control"  placeholder="Nomor Surat Perjalanan Dinas" validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="pejabat_pembuat_komitmen">Pejabat Pembuat Komitmen</label>
                                                <select name="pejabat_pembuat_komitmen" id="pejabat_pembuat_komitmen" class="form-control select2" validate>
                                                    <option value=""></option>
                                                    <option value="1">Deputi Bidang Kewirausahaan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tingkat_biaya_perjalanan_dinas">Tingkat Biaya Perjalanan Dinas</label>
                                                <input type="text" name="tingkat_biaya_perjalanan_dinas" id="tingkat_biaya_perjalanan_dinas" class="form-control"  placeholder="Tingkat Biaya Perjalanan Dinas" validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="alat_angkutan">Alat Angkutan yang Dipergunakan</label>
                                                <select name="alat_angkutan" id="alat_angkutan" class="form-control select2" validate>
                                                    <option value=""></option>
                                                    <option value="1">Pesawat</option>
                                                    <option value="2">Kereta Api</option>
                                                    <option value="3">Kapal Laut</option>
                                                    <option value="4">Kendaraan Dinas</option>
                                                    <option value="5">Kendaraan Pribadi</option>
                                                    <option value="6">Angkutan Umum</option>
                                                    <option value="7">Lainnya</option>
                                                </select>
                                            </div>
                                            <div id="showDikeluarkan_tanggal" class="form-group">
                                                <label for="dikeluarkan_tanggal">Pada Tanggal</label>
                                                <input type="text" name="pada_tanggal" id="pada_tanggal" class="form-control date"  placeholder="Pilih Tanggal SPT terbit" validate>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="btn btn-primary btn-sm" id="saveBtn" name="saveBtn" form="pengajuanForm">Save</button>
						</div>
					</div>
				</div>
			</div>
@endsection

@push('js')

<script type="text/javascript">
	// selingkuhnya programmer? yaa di vs code
    // chuaksss XD

	// apa bedanya kamu sama benda benda lama?
    // kalo benda lama itu antik tapi kamu cantik

	// mandi apa yang engga basah?
	// mandirikan rumah tangga sama kamu

	// apa bedanya kamu sama lukisan?
	// kalo lukisan makin lama makin antik
	// tapi kalo kamu makin cantik

	// perangkat apa yang romantis?
	// gagal :(

	// panda apa yang bikin seneng?
	// pandangin kamu

	// berangkat pagi pagi
	// mencari rezeki
	// demi si fitri

    $(function () {
        $('#pada_tanggal').flatpickr({
            dateFormat: "Y-m-d",
        });

        //select2
        $('.select2').select2({
            placeholder: 'Pilih Data',
            theme: 'bootstrap',
            allowClear: true
        });

    });

</script>

@endpush





