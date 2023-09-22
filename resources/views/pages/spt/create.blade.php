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

                                            <div class="form-group">
                                                <label for="nomor_spt">Nomor SPT</label>
                                                <select name="nomor_spt" id="nomor_spt" class="form-control select2" validate>
                                                    <option value="">Pilih Nomor SPT</option>
                                                    <option value="1">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;SesDep.4  /SPT/         IX            2023</option>
                                                    <option value="2">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;Dep.4  /SPT/         IX            2023</option>
                                                </select>
                                            </div>
                                            <div id="showDikeluarkan_tanggal" class="form-group">
                                                <label for="dikeluarkan_tanggal">Dikeluarkan Tanggal</label>
                                                <input type="text" name="dikeluarkan_tanggal" id="dikeluarkan_tanggal" class="form-control date"  placeholder="Pilih Tanggal SPT terbit" validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_spt">Penandatangan SPT</label>
                                                <select name="nomor_spt" id="nomor_spt" class="form-control select2" validate>
                                                    <option value="">Pilih Penandatangan</option>
                                                    @foreach ($staff as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
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
        $('#dikeluarkan_tanggal').flatpickr({
            dateFormat: "Y-m-d",
        });

    });

</script>

@endpush





