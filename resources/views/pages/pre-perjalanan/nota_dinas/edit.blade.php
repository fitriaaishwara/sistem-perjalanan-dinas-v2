@extends('pages.layouts.master')
@section('content')
@section('title', 'Nota Dinas')
            <div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Form Nota Dinas</h4>
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
								<a href="#">Nota Dinas</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Form Nota Dinas</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <form action="{{ route('nota-dinas/update', $notadinas->id) }}" method="POST" id="pengajuanForm">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Nota Dinas</div>
                                    </div>
                                    <div id="myModal" class="card-body">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="id_perjalanan" id="id_perjalanan" value="{{ $perjalanan->id }}">
                                            {{-- <input type="hidden" name="id_mak" id="id_mak" value="{{ $perjalanan->id_mak }}"> --}}
                                            <div class="form-group">
                                                <label for="nomor_nota_dinas">Nomor Nota Dinas</label>
                                                <input type="text" class="form-control" id="nomor_nota_dinas" name="nomor_nota_dinas" value="{{$notadinas->nomor_nota_dinas}}" placeholder="Nomor Nota Dinas">
                                            </div>
                                            <div class="form-group">
                                                <label for="yth">Tujuan / Yth</label>
                                                <input type="text" class="form-control" id="yth" name="yth" value="{{$notadinas->yth}}" placeholder="Tujuan Nota Dinas / Yth">
                                            </div>
                                            <div class="form-group">
                                                <label for="dari">Dari</label>
                                                <input type="text" class="form-control" id="dari" name="dari" value="{{$notadinas->dari}}" placeholder="Nota Dinas Dari">
                                            </div>
                                            <div class="form-group">
                                                <label for="perihal">Perihal</label>
                                                <input type="text" class="form-control" id="perihal" name="perihal" value="{{$notadinas->perihal}}" placeholder="Perihal Nota Dinas" value="{{ $perjalanan->perihal_perjalanan }}" readonly>
                                            </div>
                                            <div id="showTanggal_nota_dinas" class="form-group">
                                                <label for="tanggal_nota_dinas">Tanggal Nota Dinas</label>
                                                <input type="text" name="tanggal_nota_dinas" value="{{ $notadinas->tanggal_nota_dinas }}" id="tanggal_nota_dinas" class="form-control date"  placeholder="Pilih Tanggal Nota Dinas" validate>
                                            </div>
                                            <div class="form-group">
                                                <label for="isi_nota_dinas">Dalam Rangka Nota Dinas</label>
                                                <textarea class="form-control" id="isi_nota_dinas" name="isi_nota_dinas" rows="3" placeholder="Isi Nota Dinas">{{$notadinas->isi_nota_dinas}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_staff_penandatangan">Ditandatangani Oleh: </label>
                                                <select class="form-control select2" id="id_staff_penandatangan" name="id_staff_penandatangan">
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
                            <a href="{{route('nota-dinas')}}" type="button" class="btn btn-outline-primary btn-sm">Back</a>
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
        $('#tanggal_nota_dinas').flatpickr({
            // dateFormat: "d-m-Y",
        });

        $("#id_staff_penandatangan").val("{{ $notadinas->id_staff_penandatangan }}").trigger('change');
    });

</script>

@endpush





