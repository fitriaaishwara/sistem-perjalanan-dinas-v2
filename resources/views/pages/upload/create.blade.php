@extends('pages.layouts.master')
@section('content')
@section('title', 'Upload Dokumen')

        <!-- Modal -->
        <div id="myModalBerangkat" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalBerangkatLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header border-0" id="myModalBerangkatLabel">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                            Upload</span>
                            <span class="fw-light">
                                Dokumen Transportasi Berangkat
                            </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('transportasiBerangkat/store') }}" id="transportasiBerangkatForm" name="transportasiBerangkatForm">
                            @csrf
                            <input id="id" type="hidden" class="form-control" name="id">
                            <input id="id_staff_perjalanan" type="hidden" class="form-control" name="id_staff_perjalanan" value="{{ $dataStaff->id }}">
                            <div class="row mb-4">
                                <label for="id_transportasi" class="col-sm-3 col-form-label">Transportasi<span
                                        style="color:red;">*</span></label>
                                <div class="col-sm-9 validate">
                                    <select class="form-control id_transportasi_berangkat" id="id_transportasi_berangkat" name="id_transportasi">
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="deskripsi_file" class="col-sm-3 col-form-label">Nama File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="deskripsi_file" name="deskripsi_file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="file" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="file_path" name="file_path" type="file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="nominal" name="nominal">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtn"
                            name="saveBtn">Save changes</button>
                        <button type="button" class="btn btn-secondary waves-effect btn-sm"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModalPulang" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalPulangLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header border-0" id="myModalPulangLabel">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                            Upload</span>
                            <span class="fw-light">
                                Dokumen Transportasi Pulang
                            </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('transportasiPulang/store') }}" id="transportasiPulangForm" name="transportasiPulangForm">
                            @csrf
                            <input id="id" type="hidden" class="form-control" name="id">
                            <input id="id_staff_perjalanan" type="hidden" class="form-control" name="id_staff_perjalanan" value="{{ $dataStaff->id }}">
                            <div class="row mb-4">
                                <label for="id_transportasi" class="col-sm-3 col-form-label">Transportasi<span
                                        style="color:red;">*</span></label>
                                <div class="col-sm-9 validate">
                                    <select class="form-control id_transportasi_pulang" id="id_transportasi_pulang" name="id_transportasi">
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="deskripsi_file" class="col-sm-3 col-form-label">Nama File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="deskripsi_file" name="deskripsi_file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="file" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="file_path" name="file_path" type="file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="nominal" name="nominal">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtnPulang"
                            name="saveBtnPulang">Save changes</button>
                        <button type="button" class="btn btn-secondary waves-effect btn-sm"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModalHotel" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalHotelLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header border-0" id="myModalHotelLabel">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                            Upload</span>
                            <span class="fw-light">
                                Dokumen Akomodasi Hotel
                            </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('hotel/store') }}" id="hotelForm" name="hotelForm">
                            @csrf
                            <input id="id" type="hidden" class="form-control" name="id">
                            <input id="id_staff_perjalanan" type="hidden" class="form-control" name="id_staff_perjalanan" value="{{ $dataStaff->id }}">
                            <div class="row mb-4">
                                <label for="nama_hotel" class="col-sm-3 col-form-label">Nama Hotel</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="nama_hotel" name="nama_hotel">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="deskripsi_file" class="col-sm-3 col-form-label">Nama File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="deskripsi_file" name="deskripsi_file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="file" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="file_path" name="file_path" type="file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="tanggal_check_in" class="col-sm-3 col-form-label">Waktu Check In<span
                                        style="color:red;">*</span></label>
                                <div class="col-sm-9 validate">
                                    <input id="tanggal_check_in" type="text" class="form-control" name="tanggal_check_in">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="tanggal_check_out" class="col-sm-3 col-form-label">Waktu Check Out<span
                                        style="color:red;">*</span></label>
                                <div class="col-sm-9 validate">
                                    <input id="tanggal_check_out" type="text" class="form-control" name="tanggal_check_out">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="nominal" name="nominal">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtnHotel"
                            name="saveBtnHotel">Save changes</button>
                        <button type="button" class="btn btn-secondary waves-effect btn-sm"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Upload Dokumen</h4>
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
                            <a href="#">Master Data</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Upload File</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Transportasi Berangkat</h4>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                        data-toggle="modal" data-target="#myModalBerangkat" id="addNew" name="addNew"><i class="fa fa-plus"></i></a>
                                        {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>Create
                                        </button> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="berangkatTable" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Transportasi</th>
                                                <th>File</th>
                                                <th>Nominal</th>
                                                <th>Ukuran File</th>
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
                                    <h4 class="card-title">Transportasi Pulang</h4>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                        data-toggle="modal" data-target="#myModalPulang" id="addNew" name="addNew"><i class="fa fa-plus"></i></a>
                                        {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>Create
                                        </button> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="pulangTable" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Transportasi</th>
                                                <th>File</th>
                                                <th>Nominal</th>
                                                <th>Ukuran File</th>
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
                                    <h4 class="card-title">Akomodasi Hotel</h4>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                        data-toggle="modal" data-target="#myModalHotel" id="addNew" name="addNew"><i class="fa fa-plus"></i></a>
                                        {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>Create
                                        </button> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="hotelTable" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Hotel</th>
                                                <th>File</th>
                                                <th>Waktu Menginap</th>
                                                <th>Nominal</th>
                                                <th>Ukuran File</th>
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

    function rupiah($angka){
        var reverse = $angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    $(function() {
        let request = {
            start: 0,
            length: 10
        };
        var isUpdate = false;

        var berangkatTable = $('#berangkatTable').DataTable({
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
                "url": "{{ route('uploadByIdBerangkat/getData', ['id_staff_perjalanan' => $dataStaff]) }}",
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
                    "data": "transportasi.name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                    },
                },
                {
                    "data": "file_path",
                    "width": '15%',
                    "defaultContent": "-",

                },
                {
                    "data": "nominal",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                           //format_rupiah
                            return "<div class='text-wrap' style='font-size: 12px;'>Rp. " + rupiah(data) + "</div>";
                        },
                },
                {
                    "data": "ukuran_file",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data == null) {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data + " KB</div>";
                        }
                    },
                },

                {
                    "data": "id",
                    "width": '10%',
                    render: function(data, type, row) {
                        var btnEdit = "";
                        var btnDelete = "";
                        btnEdit += '<button name="btnEdit" data-id="' + data +
                            '" type="button" class="btn btn-warning btn-sm btnEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></button>';
                        btnDelete += '<button name="btnDelete" data-id="' + data +
                            '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';

                        return btnEdit + btnDelete;
                    },
                },
            ]
        });

        function reloadTable() {
            berangkatTable.ajax.reload(null, false); //reload datatable ajax
        }

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            var isValid = $("#transportasiBerangkatForm").valid();
            if (isValid) {
                $('#saveBtn').text('Save...');
                $('#saveBtn').attr('disabled', true);
                if (!isUpdate) {
                    var url = "{{ route('transportasiBerangkat/store') }}";
                } else {
                    var url = "{{ route('transportasiBerangkat/update') }}";
                }
                var formData = new FormData($('#transportasiBerangkatForm')[0]);
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
                        $('#saveBtn').text('Save');
                        $('#saveBtn').attr('disabled', false);
                        reloadTable();
                        $('#myModalBerangkat').modal('hide');
                    },
                    error: function(data) {
                        Swal.fire(
                            'Error',
                            'A system error has occurred. please try again later.',
                            'error'
                        )
                        $('#saveBtn').text('Save');
                        $('#saveBtn').attr('disabled', false);
                    }
                });
            }
        });

        $('#berangkatTable').on("click", ".btnEdit", function() {
            $('#myModalBerangkat').modal('show');
            isUpdate = true;
            var id = $(this).attr('data-id');
            var url = "{{ route('transportasiBerangkat/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#name').val(response.data.name);
                    $('#description').val(response.data.description);
                    $('#id').val(response.data.id);
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

        $('#berangkatTable').on("click", ".btnDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "Kamu akan menghapus transportasi berangkat. Apakah kamu ingin melanjutkan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, I'm sure",
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('transportasiBerangkat/delete', ['id' => ':id']) }}";
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

        $("#id_transportasi_berangkat").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModalBerangkat'),
            placeholder: "Pilih Transportasi",
            ajax: {
                url: "{{ route('transportasi/getData') }}",
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

        $('#transportasiBerangkatForm').validate({
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

        $('#addNew').on('click', function() {
            $('#name').val("");
            isUpdate = false;
        });
    });

    $(function() {
        let request = {
            start: 0,
            length: 10
        };
        var isUpdate = false;

        var pulangTable = $('#pulangTable').DataTable({
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
                "url": "{{ route('uploadByIdPulang/getData', ['id_staff_perjalanan' => $dataStaff]) }}",
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
                    "data": "transportasi.name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                    },
                },
                {
                    "data": "file_path",
                    "width": '15%',
                    "defaultContent": "-",

                },
                {
                    "data": "nominal",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                           //format_rupiah
                            return "<div class='text-wrap' style='font-size: 12px;'>Rp. " + rupiah(data) + "</div>";
                        },
                    },
                {
                    "data": "ukuran_file",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data == null) {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data + " KB</div>";
                        }
                    },
                },

                {
                    "data": "id",
                    "width": '10%',
                    render: function(data, type, row) {
                        var btnEdit = "";
                        var btnDelete = "";
                        btnEdit += '<button name="btnEdit" data-id="' + data +
                            '" type="button" class="btn btn-warning btn-sm btnEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></button>';
                        btnDelete += '<button name="btnDelete" data-id="' + data +
                            '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';

                        return btnEdit + btnDelete;
                    },
                },
            ]
        });

        function reloadTable() {
            pulangTable.ajax.reload(null, false); //reload datatable ajax
        }

        $('#saveBtnPulang').click(function(e) {
            e.preventDefault();
            var isValid = $("#transportasiPulangForm").valid();
            if (isValid) {
                $('#saveBtnPulang').text('Save...');
                $('#saveBtnPulang').attr('disabled', true);
                if (!isUpdate) {
                    var url = "{{ route('transportasiPulang/store') }}";
                } else {
                    var url = "{{ route('transportasiPulang/update') }}";
                }
                var formData = new FormData($('#transportasiPulangForm')[0]);
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
                        $('#saveBtnPulang').text('Save');
                        $('#saveBtnPulang').attr('disabled', false);
                        reloadTable();
                        $('#myModalPulang').modal('hide');
                    },
                    error: function(data) {
                        Swal.fire(
                            'Error',
                            'A system error has occurred. please try again later.',
                            'error'
                        )
                        $('#saveBtnPulang').text('Save');
                        $('#saveBtnPulang').attr('disabled', false);
                    }
                });
            }
        });

        $('#pulangTable').on("click", ".btnEdit", function() {
            $('#myModalPulang').modal('show');
            isUpdate = true;
            var id = $(this).attr('data-id');
            var url = "{{ route('transportasiPulang/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#name').val(response.data.name);
                    $('#description').val(response.data.description);
                    $('#id').val(response.data.id);
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

        $('#pulangTable').on("click", ".btnDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "Kamu akan menghapus transportasi pulang. Apakah kamu ingin melanjutkan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, I'm sure",
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('transportasiPulang/delete', ['id' => ':id']) }}";
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

        $("#id_transportasi_pulang").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModalPulang'),
            placeholder: "Pilih Transportasi",
            ajax: {
                url: "{{ route('transportasi/getData') }}",
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

        $('#transportasiPulangForm').validate({
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

        $('#addNew').on('click', function() {
            $('#name').val("");
            isUpdate = false;
        });
    });

    $(function() {
        let request = {
            start: 0,
            length: 10
        };
        var isUpdate = false;

        var pulangTable = $('#hotelTable').DataTable({
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
                "url": "{{ route('uploadByIdHotel/getData', ['id_staff_perjalanan' => $dataStaff]) }}",
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
                    "data": "nama_hotel",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                    },
                },
                {
                    "data": "file_path",
                    "width": '15%',
                    "defaultContent": "-",

                },
                {
                    "data": "tanggal_check_in",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + moment(data).format('DD MMM YYYY') + " s/d " + moment(row.tanggal_check_out).format('DD MMM YYYY') + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }

                },
                {
                    "data": "nominal",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                           //format_rupiah
                            return "<div class='text-wrap' style='font-size: 12px;'>Rp. " + rupiah(data) + "</div>";
                        },
                },
                {
                    "data": "ukuran_file",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data == null) {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data + " KB</div>";
                        }
                    },
                },

                {
                    "data": "id",
                    "width": '10%',
                    render: function(data, type, row) {
                        var btnEdit = "";
                        var btnDelete = "";
                        btnEdit += '<button name="btnEdit" data-id="' + data +
                            '" type="button" class="btn btn-warning btn-sm btnEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></button>';
                        btnDelete += '<button name="btnDelete" data-id="' + data +
                            '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';

                        return btnEdit + btnDelete;
                    },
                },
            ]
        });

        function reloadTable() {
            hotelTable.ajax.reload(null, false); //reload datatable ajax
        }

        $('#tanggal_check_in').flatpickr({
            dateFormat: "Y-m-d",
            //disable past date
            minDate: "today",
        });

        $('#tanggal_check_out').flatpickr({
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        $('#saveBtnHotel').click(function(e) {
            e.preventDefault();
            var isValid = $("#hotelForm").valid();
            if (isValid) {
                $('#saveBtnHotel').text('Save...');
                $('#saveBtnHotel').attr('disabled', true);
                if (!isUpdate) {
                    var url = "{{ route('hotel/store') }}";
                } else {
                    var url = "{{ route('hotel/update') }}";
                }
                var formData = new FormData($('#hotelForm')[0]);
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
                        $('#saveBtnHotel').text('Save');
                        $('#saveBtnHotel').attr('disabled', false);
                        reloadTable();
                        $('#myModalPulang').modal('hide');
                    },
                    error: function(data) {
                        Swal.fire(
                            'Error',
                            'A system error has occurred. please try again later.',
                            'error'
                        )
                        $('#saveBtnHotel').text('Save');
                        $('#saveBtnHotel').attr('disabled', false);
                    }
                });
            }
        });

        $('#hotelTable').on("click", ".btnEdit", function() {
            $('#myModalHotel').modal('show');
            isUpdate = true;
            var id = $(this).attr('data-id');
            var url = "{{ route('hotel/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#name').val(response.data.name);
                    $('#description').val(response.data.description);
                    $('#id').val(response.data.id);
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

        $('#hotelTable').on("click", ".btnDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "Kamu akan menghapus transportasi pulang. Apakah kamu ingin melanjutkan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, I'm sure",
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('hotel/delete', ['id' => ':id']) }}";
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

        $('#hotelForm').validate({
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

        $('#addNew').on('click', function() {
            $('#name').val("");
            isUpdate = false;
        });
    });
</script>
@endpush


