@extends('pages.layouts.master')
@section('content')
@section('title', 'Nota Dinas')
<style>
    #keteranganField {
        display: none;
    }
</style>
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
                <form action="{{ route('nota-dinas/store') }}" method="POST" id="pengajuanForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Nota Dinas</div>
                        </div>
                        <div id="myModal" class="card-body">
                            <div class="col-lg-12">
                                <input type="hidden" name="id_perjalanan" id="id_perjalanan" value="{{ $perjalanan->id }}">
                                <div class="form-group">
                                    <label for="nomor_nota_dinas">Nomor Nota Dinas</label>
                                    <input type="text" class="form-control" id="nomor_nota_dinas" name="nomor_nota_dinas" placeholder="Nomor Nota Dinas">
                                </div>
                                <div class="form-group">
                                    <label for="yth">Tujuan / Yth</label>
                                    <input type="text" class="form-control" id="yth" name="yth" placeholder="Tujuan Nota Dinas / Yth">
                                </div>
                                <div class="form-group">
                                    <label for="dari">Dari</label>
                                    <input type="text" class="form-control" id="dari" name="dari" placeholder="Nota Dinas Dari">
                                </div>
                                <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal Nota Dinas">
                                </div>
                                <div class="form-group">
                                    <label for="perihal">Lampiran</label>
                                    <input type="text" class="form-control" id="lampiran" name="lampiran" placeholder="Perihal Nota Dinas">
                                </div>
                                <div id="showTanggal_nota_dinas" class="form-group">
                                    <label for="tanggal_nota_dinas">Tanggal Nota Dinas</label>
                                    <input type="text" name="tanggal_nota_dinas" id="tanggal_nota_dinas" class="form-control date"  placeholder="Pilih Tanggal Nota Dinas" validate>
                                </div>
                                <div class="form-group">
                                    <label for="isi_nota_dinas">Dalam Rangka Nota Dinas</label>
                                    <textarea class="form-control" id="isi_nota_dinas" name="isi_nota_dinas" rows="3" placeholder="Isi Nota Dinas"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nip_staff_penandatangan">Ditandatangani Oleh: </label>
                                    <select class="form-control select2" id="nip_staff_penandatangan" name="nip_staff_penandatangan">
                                        <option value="">Pilih Penandatangan</option>
                                        @foreach ($staff as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_nota_dinas">Table</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_nota_dinas" name="status_nota_dinas">
                                        <label class="custom-control-label" for="status_nota_dinas" id="statusLabel">Off</label>
                                    </div>
                                    <input type="hidden" id="status_nota_dinas_hidden" name="status_nota_dinas_hidden" value="0">
                                </div>

                                <div class="form-group">
                                    <label for="status_keterangan">Tembusan</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_keterangan" name="status_keterangan">
                                        <label class="custom-control-label" for="status_keterangan" id="keteranganLabel">Off</label>
                                    </div>
                                    <input type="hidden" id="status_keterangan_hidden" name="status_keterangan_hidden" value="0">
                                </div>

                                <div class="form-group" id="keteranganField" style="display: none;">
                                    <label for="keterangan">Tembusan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Tembusan"></textarea>
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
    $(function () {

        // Toggle button for status_keterangan
        $('#status_keterangan').change(function () {
            var status = $(this).is(':checked') ? 1 : 0;
            $('#keteranganLabel').text($(this).is(':checked') ? 'On' : 'Off');
            $('#status_keterangan_hidden').val(status);

            // Show/hide keterangan field based on status_keterangan
            if (status === 1) {
                $('#keteranganField').show();
            } else {
                $('#keteranganField').hide();
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#tanggal_nota_dinas').flatpickr({
            // dateFormat: "d-m-Y",
        });

        // Toggle button for status_nota_dinas
        $('#status_nota_dinas').change(function () {
            var status = $(this).is(':checked') ? 1 : 0;
            $('#statusLabel').text($(this).is(':checked') ? 'On' : 'Off');
            $('#status_nota_dinas_hidden').val(status);
        });
    });
</script>
@endpush
