@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Pengajuan')
<!-- Modal -->
<div id="myModalTujuan" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalTujuanLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header border-0" id="myModalTujuanLabel">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Tujuan</span>
                    <span class="fw-light">
                        Perjalanan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('tujuan/store') }}" id="tujuanForm" name="tujuanForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input id="id_perjalanan" type="hidden" class="form-control" name="id_perjalanan" value="{{ $perjalanan->id }}">
                    <div class="row mb-4">
                        <label for="tempat_berangkat_id" class="col-sm-3 col-form-label">Tempat Berangkat<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <select id="tempat_berangkat_id" type="text" class="form-control tempat_berangkat_id"
                                name="tempat_berangkat_id">
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="tempat_tujuan_id" class="col-sm-3 col-form-label">Tempat Pulang<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <select id="tempat_tujuan_id" type="text" class="form-control tempat_tujuan_id"
                                name="tempat_tujuan_id">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="tanggal_berangkat" class="col-sm-3 col-form-label">Tanggal Berangkat<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input id="tanggal_berangkat" type="text" class="form-control" name="tanggal_berangkat">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="tanggal_pulang" class="col-sm-3 col-form-label">Tanggal Pulang<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input id="tanggal_pulang" type="text" class="form-control" name="tanggal_pulang">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="tanggal_tiba" class="col-sm-3 col-form-label">Tanggal Tiba<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input id="tanggal_tiba" type="text" class="form-control" name="tanggal_tiba">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="lama_perjalanan" class="col-sm-3 col-form-label">Lama Perjalanan<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input id="lama_perjalanan" type="text" class="form-control" name="lama_perjalanan" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtnTujuan"
                    name="saveBtnTujuan">Save changes</button>
                <button type="button" class="btn btn-secondary waves-effect btn-sm"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="myModalStaff" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalTujuanLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Staff Yang Ditugaskan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('pengajuan/edit/save_staff', $perjalanan->id)}}" id="formStaffPilih">
                    @csrf
                    <input type="hidden" name="id_edit" id="id_edit">

                    <div class="row mb-4">
                        <label for="id_staff" class="col-sm-3 col-form-label">Staff<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <select name="id_staff" class="form-control select2" required id="id_staff">
                                <option value="">Pilih Staff</option>
                                @foreach ($staff as $item)
                                    @if ($item->status === 1)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="id_tujuan_perjalanan" class="col-sm-3 col-form-label">Informasi Tujuan<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <select name="id_tujuan_perjalanan" class="form-control select2" required id="id_tujuan_perjalanan">
                                <option value="">Pilih Tujuan</option>
                                @foreach ($perjalanan->tujuan as $item)
                                    @if ($item->status === 1)
                                        <option value="{{ $item->id }}">{{ $item->tempatBerangkat->name }} - {{ $item->tempatTujuan->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="$('form#formStaffPilih').submit()" class="btn btn-dark waves-effect waves-light btn-sm">Save changes</button>
                <button type="button" class="btn btn-secondary waves-effect btn-sm"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Informasi Tujuan</h4>
                            <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                data-toggle="modal" data-target="#myModalTujuan" id="addNewTujuan" name="addNewTujuan"><i class="fa fa-plus"></i> Tambah</a>
                                {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                <i class="fa fa-plus"></i>Create
                                </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tujuanTable" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tempat Berangkat</th>
                                        <th>Tempat Tujuan</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Tanggal Tiba</th>
                                        <th>Lama Perjalanan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Staff Yang Ditugaskan</h4>
                            <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                data-toggle="modal" data-target="#myModalStaff" id="addNewStaff" name="addNewTujuan"><i class="fa fa-plus"></i> Tambah</a>
                                {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                <i class="fa fa-plus"></i>Create
                                </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="staffTable" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Jabatan</th>
                                        <th>Golongan</th>
                                        <th>Instansi</th>
                                        <th>Tujuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

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

@push('js')

<script type="text/javascript">
    $(function () {
        let request = {
            start: 0,
            length: 10
        };
        var isUpdate = false;
        var jabatanTable = $('#tujuanTable').DataTable({
            "language": {
                "paginate": {
                    "next": '<i class="fas fa-arrow-right"></i>',
                    "previous": '<i class="fas fa-arrow-left"></i>'
                }
            },
            "aaSorting": [],
            "autoWidth": false,
            "ordering": false,
            "serverSide": true,
            "responsive": true,
            "lengthMenu": [
                [10, 15, 25, 50, -1],
                [10, 15, 25, 50, "All"]
            ],
            "ajax": {
                "url": "{{ route('tujuanById/getData' , ['id_perjalanan' => $perjalanan->id]) }}",
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
                "beforeSend": function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + $('#secret').val());
                },
                "Content-Type": "application/json",
                "data": function(data) {
                    request.draw = data.draw;
                    request.start = data.start;
                    request.length = data.length;
                    request.searchkey = data.search.value || "";
                    return (request);
                },
            },
            "columns": [{
                    "data": null,
                    "width": '5%',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "tempat_berangkat",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.name) {
                            return "<div class='text-wrap'>" + data.name + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    },
                },
                {
                    "data": "tempat_tujuan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.name) {
                            return "<div class='text-wrap'>" + data.name + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    },
                },
                {
                    "data": "tanggal_berangkat",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + formatIndonesianDate(data) + "</div>";

                    },
                },
                {
                    "data": "tanggal_pulang",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + formatIndonesianDate(data) + "</div>";
                    },
                },
                {
                    "data": "tanggal_tiba",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + formatIndonesianDate(data) + "</div>";
                    },
                },
                {
                    "data": "lama_perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + " " + "Hari" + "</div>";
                    },
                },
                {
                    "data": "id",
                    "width": '10%',
                    render: function(data, type, row) {
                        var btnTujuanEdit = "";
                        // var btnTujuanDelete = "";
                        btnTujuanEdit += '<button name="btnTujuanEdit" data-id="' + data +
                            '" type="button" class="btn btn-warning btn-sm btnTujuanEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></button>';
                        // btnTujuanDelete += '<button name="btnTujuanDelete" data-id="' + data +
                        //     '" type="button" class="btn btn-danger btn-sm btnTujuanDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';
                        return btnTujuanEdit;
                    },
                },
            ]
        });
        function reloadTable(){
            tujuanTable.ajax.reload(null, false); // Reload datatable ajax
            window.location.reload(); // Reload the page
        }

        $("#tempat_berangkat_id").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModalTujuan'),
            placeholder: "Pilih Tempat Berangkat",
            ajax: {
                url: "{{ route('provinsi/getData') }}",
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
                            result.results.push({
                                id: this.id,
                                text: this.name
                            });
                        })
                    }
                    return result;
                },
                cache: false
            },
        });

        $("#tempat_tujuan_id").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModalTujuan'),
            placeholder: "Pilih Tempat Pulang",
            ajax: {
                url: "{{ route('provinsi/getData') }}",
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
                            result.results.push({
                                id: this.id,
                                text: this.name
                            });
                        })
                    }
                    return result;
                },
                cache: false
            },
        });

        $('#saveBtnTujuan').click(function(e) {
            e.preventDefault();
            var isValid = $("#tujuanForm").valid();
            if (isValid) {
                $('#saveBtnTujuan').text('Save...');
                $('#saveBtnTujuan').attr('disabled', true);
                if (!isUpdate) {
                    var url = "{{ route('tujuan/store') }}";
                } else {
                    var url = "{{ route('tujuan/update') }}";
                }
                var formData = new FormData($('#tujuanForm')[0]);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire(
                            (data.status) ? 'Success' : 'Error',
                            data.message,
                            (data.status) ? 'success' : 'error'
                        )
                        $('#saveBtnTujuan').text('Save');
                        $('#saveBtnTujuan').attr('disabled', false);
                        reloadTable();
                        $('#myModal').modal('hide');
                        //if success close modal and reload ajax table
                        $('#myModalTujuan').modal('hide');
                        window.location.reload(); // Reload the page
                    },
                    error: function(data) {
                        Swal.fire(
                            'Error',
                            'A system error has occurred. please try again later.',
                            'error'
                        )
                        $('#saveBtnTujuan').text('Save');
                        $('#saveBtnTujuan').attr('disabled', false);
                    }
                });
            }
        });

        $('#tujuanTable').on("click", ".btnTujuanEdit", function() {
            $('#myModalTujuan').modal('show');
            isUpdate = true;
            var id = $(this).attr('data-id');
            var url = "{{ route('tujuan/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#tempat_berangkat').val(response.data.tempat_berangkat);
                    $('#tempat_tujuan').val(response.data.tempat_tujuan);
                    $('#tanggal_berangkat').val(response.data.tanggal_berangkat);
                    $('#tanggal_pulang').val(response.data.tanggal_pulang);
                    $('#tanggal_tiba').val(response.data.tanggal_tiba);
                    $('#lama_perjalanan').val(response.data.lama_perjalanan);
                    $('#id').val(response.data.id);

                    if (response.data.tempat_berangkat) {
                        var berangkat = new Option(response.data.tempat_berangkat.name, response.data.tempat_berangkat.id, true, true);
                        $('.tempat_berangkat_id').append(berangkat).trigger('change');
                    }

                    if (response.data.tempat_tujuan) {
                        var pulang = new Option(response.data.tempat_tujuan.name, response.data.tempat_tujuan.id, true, true);
                        $('.tempat_tujuan_id').append(pulang).trigger('change');
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'A system error has occurred. please try again later.',
                        'error'
                    )
                },
            });
        });
        $('#tujuanTable').on("click", ".btnTujuanDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "Kamu akan menghapus tujuan. Apakah kamu ingin melanjutkan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, I'm sure",
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('tujuan/delete', ['id' => ':id']) }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                        url: url,
                        type: "POST",
                        success: function(data) {
                            Swal.fire(
                                (data.status) ? 'Success' : 'Error',
                                data.message,
                                (data.status) ? 'success' : 'error'
                            )
                            reloadTable();
                            //if success close modal and reload ajax table
                            $('#myModalTujuan').modal('hide');
                            window.location.reload(); // Reload the page

                        },
                        error: function(response) {
                            Swal.fire(
                                'Error',
                                'A system error has occurred. please try again later.',
                                'error'
                            )
                        }
                    });
                }
            })
        });

        $('#tujuanForm').validate({
            rules: {
                name: {
                    required: true,
                },
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

        $('#staffForm').validate({
            rules: {
                name: {
                    required: true,
                },
                tempat_berangkat_id: {
                    required: true,
                },
                tempat_tujuan_id: {
                    required: true,
                },
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

        $('#addNewTujuan').on('click', function() {
            $('#name').val("");
            $('#tempat_berangkat_id').val("").trigger('change');
            $('#tempat_tujuan_id').val("").trigger('change');
            isUpdate = false;
        });

        $('#tanggal_berangkat').flatpickr({
            dateFormat: "Y-m-d",
            //disable past date
            minDate: "today",
        });

        $('#tanggal_pulang').flatpickr({
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        $('#tanggal_tiba').flatpickr({
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        //make tangga_berangkat and tanggal_kembali to be total days without save data hasilnya berupa misal 2 hari
        $('#tanggal_berangkat , #tanggal_pulang').change(function(){
            var tanggal_berangkat = $('#tanggal_berangkat').val();
            var tanggal_kembali = $('#tanggal_pulang').val();
			if(tanggal_berangkat != '' && tanggal_kembali != '') {
				var date1 = new Date(tanggal_berangkat);
				var date2 = new Date(tanggal_kembali);
				var Difference_In_Time = date2.getTime() - date1.getTime();
				var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24) + 1;
				$('#lama_perjalanan').val(Difference_In_Days);
			} else {
				$('#lama_perjalanan').val('0');
			}
        });

        $("#id_mak").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myForm'),
            placeholder: "Pilih Kode Akun / Mata Anggaran Kegiatan",
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
                            result.results.push({
                                id: this.id,
                                text: this.kode_mak
                            });
                        })
                    }
                    return result;
                },
                cache: false
            },
        });

        var staffTable = $('#staffTable').DataTable({
            "language": {
                "paginate": {
                    "next": '<i class="fas fa-arrow-right"></i>',
                    "previous": '<i class="fas fa-arrow-left"></i>'
                }
            },
            "aaSorting": [],
            "autoWidth": false,
            "ordering": false,
            "serverSide": true,
            "responsive": true,
            "lengthMenu": [
                [10, 15, 25, 50, -1],
                [10, 15, 25, 50, "All"]
            ],
            "ajax": {
                "url": "{{ route('staffById/getData' , ['id_perjalanan' => $perjalanan->id]) }}",
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
                "beforeSend": function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + $('#secret').val());
                },
                "Content-Type": "application/json",
                "data": function(data) {
                    request.draw = data.draw;
                    request.start = data.start;
                    request.length = data.length;
                    request.searchkey = data.search.value || "";
                    return (request);
                },
            },
            "columns": [{
                    "data": null,
                    "width": '5%',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "staff.name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "staff.jenis",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if(data == 0){
                            return "<div class='text-wrap'>PNS</div>";
                        }else if(data == 1){
                            return "<div class='text-wrap'>Non PNS (PPPK)</div>";
                        }else if(data == 2){
                            return "<div class='text-wrap'>Honorer</div>";
                        }else{
                            return "<div class='text-wrap'>Lainnya</div>";
                        }
                    },
                },
                {
                    "data": "staff.jabatans.name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "staff.golongans.name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "staff.instansis.name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "tujuan_perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data[0].tempat_berangkat.name + " - " + data[0].tempat_tujuan.name + "</div>";
                    },
                },
                {
                    "data": "id",
                    "width": '10%',
                    render: function(data, type, row) {
                        var btnTujuanEdit = "";
                        var btnTujuanDelete = "";
                        btnTujuanEdit += '<button name="btnTujuanEdit" data-id="' + data +
                            '" type="button" class="btn btn-warning btn-sm btnTujuanEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></button>';
                        // btnTujuanDelete += '<button name="btnTujuanDelete" data-id="' + data +
                        //     '" type="button" class="btn btn-danger btn-sm btnTujuanDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';
                        return btnTujuanEdit + btnTujuanDelete;
                    },
                },
            ]
        });

        function reloadTable() {
            staffTable.ajax.reload(null, false); // Reload datatable ajax
        }




    });

</script>

@endpush





