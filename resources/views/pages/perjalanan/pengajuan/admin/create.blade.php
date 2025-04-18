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
            <button type="submit" class="btn btn-primary btn-round ml-auto" id="saveBtn" name="saveBtn" form="pengajuanForm">Simpan</button>
            {{-- <button type="submit" class="btn btn-primary btn-sm" id="saveBtn" name="saveBtn" form="pengajuanForm">Save</button> --}}
        </div>
        <div class="row" id="myForm">
            <div class="col-md-12">
                <form action="{{ route('pengajuan/store') }}" method="POST" id="pengajuanForm" name="pengajuanForm">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Informasi Perjalanan</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="id_mak" class="form-label">Kode Akun / Mata Anggaran Kegiatan<span
                                            style="color:red;">*</span>
                                    </label>
                                    <select id="id_mak" type="text" class="form-control col-12 id_mak"
                                    name="id_mak">
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" id="saveBtn" name="saveBtn" form="pengajuanForm">Save</button>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script type="text/javascript">
    $(function() {
        $("#id_mak").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myForm'),
            placeholder: "Pilih MAK",
            ajax: {
                url: "{{ route('mak/getData') }}",
                dataType: 'json',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                method: 'POST',
                delay: 250,
                destroy: true,
                data: function(params) {
                    var query = {
                        searchkey: params.term || '',
                        start: 0,
                        length: 50
                    }
                    return JSON.stringify(query);
                },
                processResults: function(data) {
                    var result = {
                        results: [],
                        more: false
                    };
                    if (data && data.data) {
                        $.each(data.data, function() {
                            var saldo = parseFloat(this.saldo_pagu).toLocaleString('id-ID'); // Format saldo_pagu
                            result.results.push({
                                id: this.id,
                                text: this.kode_mak + ' - [Saldo = Rp. ' + saldo + ']'
                            });
                        })
                    }
                    return result;
                },
                cache: false
            },
        });


        $('#pengajuanForm').validate({
                rules: {
                    id_mak: {
                        required: true,
                    },
                    perihal_perjalanan: {
                        required: true,
                    },
                    // estimasi_biaya: {
                    //     required: true,
                    // },


                },
                errorElement: 'em',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.validate').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


    });


</script>

@endpush



