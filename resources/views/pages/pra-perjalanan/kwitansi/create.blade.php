@extends('pages.layouts.master')
@section('content')
@section('title', 'Kwitansi')
            <div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Kwitansi</h4>
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
								<a href="#">Kwitansi</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Kwitansi</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <form action="{{ route('kwitansi/store') }}" method="POST" id="pengajuanForm" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div id="myModal" class="card-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="nomor_spt">Kode Akun</label>
                                                <input type="text" class="form-control" value="{{ $dataStaff->perjalanan[0]->mak->kode_mak }}" readonly validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="bukti_kas_nomor">Bukti Kas No</label>
                                                <input type="text" class="form-control" id="bukti_kas_nomor" name="bukti_kas_nomor">
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_anggaran">Tahun Anggaran</label>
                                                <input type="text" class="form-control"  value="{{ date('Y') }}" readonly validate id="tahun_anggaran" name="tahun_anggaran">
                                            </div>
                                            <div class="form-group">
                                                <label for="sudah_diterima_dari">Sudah Diterima Dari</label>
                                                <input type="text" class="form-control"  value="Pejabat Pembuat Komitmen Deputi Bidang Kegiatan" readonly validate id="sudah_diterima_dari" name="sudah_diterima_dari">
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Uang Sebesar</label>
                                                <input type="text" class="form-control" value="{{ format_rupiah($dataStaff->total_biaya) }}" readonly validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Untuk Pembayaran</label>
                                                <input type="text" class="form-control" value="Biaya Perjalanan Dinas dalam Rangka {{ $dataStaff->perjalanan[0]->perihal_perjalanan }}" readonly validate>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Berdasarkan SPD</div>
                                    </div>
                                    <div id="myModal" class="card-body">
                                        <div class="form-group">
                                            <label for="nomor_spt">Nomor</label>
                                            <input type="text" class="form-control" value="{{ $dataStaff->spd->nomor_spd }}" readonly validate>
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_spt">Tanggal</label>
                                            <input type="text" class="form-control" value=" {{ tgl_indo($dataStaff->spd->tanggal_spd) }} " readonly validate>
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_spt">Untuk Perjalanan Dinas Dari - Ke</label>
                                            <input type="text" class="form-control" value="{{ ($dataStaff->tujuan_perjalanan[0]->tempatBerangkat->name) }} - {{ ($dataStaff->tujuan_perjalanan[0]->tempatTujuan->name) }}" readonly validate>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div id="myModal" class="card-body">
                                        <div class="form-group">
                                            <label for="nomor_spt">Terbilang</label>
                                            <input type="text" class="form-control" value="{{ terbilang($dataStaff->total_biaya) }}" readonly validate>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_staff_perjalanan">Yang Menerima</label>
                                            <input type="hidden" name="id_staff_perjalanan" id="id_staff_perjalanan" value="{{ $dataStaff->id }}">
                                            <input type="text" class="form-control" value="{{ $dataStaff->staff->name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div id="myModal" class="card-body">
                                        <div class="form-group">
                                            <label for="id_pejabat_pembuat_komitmen">Pejabat Pembuat Komitmen</label>
                                            <select name="id_pejabat_pembuat_komitmen" id="id_pejabat_pembuat_komitmen" class="form-control select2" validate>
                                                @foreach ($staff as $item)
                                                    <option value=""></option>
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_bendahara">Bendahara</label>
                                            <select name="id_bendahara" id="id_bendahara" class="form-control select2" validate>
                                                @foreach ($staff as $item)
                                                    <option value=""></option>
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
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





