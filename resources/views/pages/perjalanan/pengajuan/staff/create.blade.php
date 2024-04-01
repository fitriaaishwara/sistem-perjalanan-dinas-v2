@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Pengajuan')
            <div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Form Pengajuan</h4>
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
								<a href="#">Pengajuan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Form Pengajuan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Informasi Pegawai</div>
								</div>
								<div class="card-body">
									<div class="col-lg-12">
                                        <div class="form-group">
											<label for="nip">NIP / NIPPPK / NIK</label>
											<input type="text" class="form-control" id="nip" name="nip" minlength="16" maxlength="16" value="{{ $pegawai->nip }}" placeholder="NIP / NIPPPK / NIK" disabled>
										</div>
                                        <div class="form-group">
											<label for="name">Nama</label>
											<input type="text" class="form-control" id="name" name="name" value="{{ $pegawai->name }}" placeholder="Nama Pegawai" disabled>
										</div>
                                            <div class="form-group">
											<label for="jabatan_id">Jabatan</label>
											<select class="form-control jabatan_id" id="jabatan_id" name="jabatan_id" disabled>
                                                <option value="{{ $pegawai->jabatan_id }}">{{ $pegawai->jabatans->name }}</option>
											</select>
										</div>
                                            <div class="form-group">
											<label for="golongan_id">Golongan</label>
											<select class="form-control golongan_id" id="golongan_id" name="golongan_id" disabled>
                                                <option value="{{ $pegawai->golongan_id }}">{{ $pegawai->golongans->name }}</option>
											</select>
										</div>
                                            <div class="form-group">
											<label for="instansi">Instansi / Perusahaan</label>
											<input type="text" class="form-control" id="instansi" name="instansi" value="{{ $pegawai->instansi }}" placeholder="Nama Instansi/Perusahaan" disabled>
										</div>
									</div>
								</div>
							</div>
                            <div class="card">
								<div class="card-header">
									<div class="card-title">Informasi Perjalanan</div>
								</div>
								<div class="card-body">
									<div class="col-lg-12">
                                        <form action="{{ route('pengajuan/store') }}" method="POST" id="pengajuanForm" name="pengajuanForm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="kode_mak">Kode Akun / Mata Anggaran Kegiatan</label>
                                                <input type="text" class="form-control" id="kode_mak" name="kode_mak" placeholder="Input Kode Akun / Mata Anggaran Kegiatan" validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Perihal Perjalanan</label>
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Input Perihal Perjalanan" validate>
                                            </div>
                                                <div class="form-group">
                                                <label for="jabatan_id">Tujuan (Provinsi/Kab/Kota)
                                                </label><input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Input Provinsi/Kab/Kota) yang dituju" validate>

                                            </div>
                                            <div id="showTanggal_Berangkat" class="form-group">
                                                <label for="tanggal_berangkat">Tanggal Berangkat</label>
                                                <input type="text" name="tanggal_berangkat" id="tanggal_berangkat" class="form-control date" placeholder="Pilih Tanggal Berangkat" validate>
                                            </div>
                                            <div id="showTanggal_Kembali" class="form-group">
                                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                                <input type="text" name="tanggal_kembali" id="tanggal_kembali" class="form-control date"  placeholder="Pilih Tanggal Kembali" validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="lama_perjalanan">Lama Perjalanan</label>
                                                <input type="text" class="form-control" id="lama_perjalanan" name="lama_perjalanan" readonly>
                                            </div>
                                        </form>
									</div>
								</div>
							</div>
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
        $('#tanggal_berangkat').flatpickr({
            dateFormat: "Y-m-d",
            //disable past date
            minDate: "today",
        });

        $('#tanggal_kembali').flatpickr({
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        //make tangga_berangkat and tanggal_kembali to be total days without save data hasilnya berupa misal 2 hari
        $('#tanggal_berangkat , #tanggal_kembali').change(function(){
            var tanggal_berangkat = $('#tanggal_berangkat').val();
            var tanggal_kembali = $('#tanggal_kembali').val();
			if(tanggal_berangkat != '' && tanggal_kembali != '') {
				var date1 = new Date(tanggal_berangkat);
				var date2 = new Date(tanggal_kembali);
				var Difference_In_Time = date2.getTime() - date1.getTime();
				var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24) + 1 + " Hari";
				$('#lama_perjalanan').val(Difference_In_Days);
			} else {
				$('#lama_perjalanan').val('0 hari');
			}
        });

    });

</script>

@endpush





