@extends('pages.layouts.master')
@section('content')
@section('title', 'Surat Perintah Tugas')
            <div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Form Surat Perintah Tugas</h4>
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
								<a href="#">Surat Perintah Tugas</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Form Surat Perintah Tugas</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <form action="{{ route('spt/store') }}" method="POST" id="pengajuanForm">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Surat Perintah Tugas</div>
                                    </div>
                                    <div id="myModal" class="card-body">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="id_perjalanan" id="id_perjalanan" value="{{ $perjalanan->id }}">
                                            <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{ $perjalanan->id_pegawai }}">
                                            <div class="form-group">
                                                <label for="nomor_spt">Nomor</label>
                                                <input type="text" class="form-control" id="nomor_spt" name="nomor_spt" placeholder="Nomor Surat Perintah Tugas">
                                            </div>
                                            <div class="form-group">
                                                <label for="dikeluarkan_di">Dikeluarkan-di</label>
                                                <input type="text" class="form-control" id="dikeluarkan_di" name="dikeluarkan_di" placeholder="Dikeluarkan-di">
                                            </div>
                                            <div id="showPada_Tanggal" class="form-group">
                                                <label for="pada_tanggal">Pada Tanggal</label>
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

    });

</script>

@endpush





