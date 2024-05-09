@extends('pages.layouts.master')
@section('content')
@section('title', 'Laporan')

<style>
    .container {
        overflow-x: auto;
        white-space: nowrap;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
</style>


<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0" id="myModalLabel">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Upload</span>
                    <span class="fw-light">
                        Laporan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('laporan/store') }}" id="laporanForm" name="laporanForm">
                    @csrf
                    <input id="id" type="hidden" class="form-control" name="id_tujuan_perjalanan">
                    <div class="row mb-4">
                        <label for="name_file" class="col-sm-3 col-form-label">Nama File<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input id="name_file" type="text" class="form-control" name="name_file">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="path_file" class="col-sm-3 col-form-label">File<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input class="form-control" id="path_file" name="path_file" type="file">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtn"
                    name="saveBtn">Save changes</button>
                <button type="button" class="btn btn-secondary waves-effect btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0" id="myModalLabel">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Upload</span>
                    <span class="fw-light">
                        Laporan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('laporan/store') }}" id="laporanForm" name="laporanForm">
                    @csrf
                    <input id="id" type="hidden" class="form-control" name="id_tujuan_perjalanan">
                    <div class="row mb-4">
                        <label for="name_file" class="col-sm-3 col-form-label">Nama File<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input id="name_file" type="text" class="form-control" name="name_file">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="path_file" class="col-sm-3 col-form-label">File<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input class="form-control" id="path_file" name="path_file" type="file">
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
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Laporan</h4>
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
                    <a href="#">Surat Pra-Perjalanan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Dokumentasi</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Laporan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            {{-- <h4 class="card-title">Data Perjalanan</h4> --}}
                            {{-- <a href="{{ route('pengajuan') }}" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i> Ajukan Perjalanan</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perihal Perjalanan</th>
                                        <th>Staff</th>
                                        <th>Tujuan</th>
                                        <th>Tgl Berangkat</th>
                                        <th>Tgl Pulang</th>
                                        <th>File</th>
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
    $(function() {
        let request = {
            start: 0,
            length: 10
        };
        var isUpdate = false;

        var myTable = $('#myTable').DataTable({
            "language": {
                "paginate": {
                    "next": '<i class="fas fa-arrow-right"></i>',
                    "previous": '<i class="fas fa-arrow-left"></i>'
                }
            },
            "aaSorting": [],
            "ordering": false,
            "responsive": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 15, 25, 50, 100, 250, 500],
                [10, 15, 25, 50, 100, 250, 500]
            ],
            "ajax": {
                "url": "{{ route('laporan/getData') }}",
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
                    "data": "perjalanan.kegiatan",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        var tujuan = "";
                        var angka = 1;
                        for (var i = 0; i < data.length; i++) {
                            tujuan += "<div class='text-wrap' style='font-size: 12px;'>" +
                                angka + ". " + data[i].kegiatan + "</div>";
                            angka++;
                        }
                        return tujuan;
                        // if (data) {
                        //     return "<div class='text-wrap'>" + data.tempat_tujuan + "</div>";
                        // } else {
                        //     return "<div class='text-wrap'>-</div>";
                        // }
                    }
                },
                {
                    "data": "perjalanan.data_staff_perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        var result = "<div class='text-wrap' style='font-size: 12px;'>";
                        $.each(data, function(key, val) {
                            // console.log(val);

                            //with number
                            result += (key + 1) + ". " + val.staff.name + "<br>";
                        });

                        result += "</div>";
                        return result;
                    }
                },
                {
                    "data": "tempat_tujuan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data
                                .name + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {
                    "data": "tanggal_berangkat",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" +
                                formatIndonesianDate(data) + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {
                    "data": "tanggal_pulang",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" +
                                formatIndonesianDate(data) + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'> - </div>";
                        }
                    }
                },
                {
                    "data": "uploadLaporan",
                    "width": '15%',
                    "defaultContent": "-",

                    render: function(data, type, row) {
                        if (row.upload_laporan == "" || row.upload_laporan == null) {
                            return "<div class='text-wrap badge badge-danger' style='font-size: 12px;'> Belum Upload </div>";
                        } else {

                            return "<a href='/laporan/pdf/" + row.upload_laporan.id +
                                "' target='_blank' class='fas fa-file-download text-center' style='font-size: 12px;'> " +
                                row.upload_laporan.name_file + " .pdf </a>"
                        }
                    }
                },
                {
                    "data": "id",
                    "width": '15%',
                    render: function(data, type, row) {
                        var btnTambah = "";
                        var btnEdit = "";

                        if (row.upload_laporan == "" || row.upload_laporan == null) {
                            btnTambah += '<button name="btnTambah" data-id="' + data +
                                '" type="button" class="btn btn-primary btn-sm btnTambah m-1" data-toggle="tooltip" data-placement="top" title="Tambah"><i class="fa fa-plus"></i></button>';
                        } else {
                            btnEdit += '<button name="btnEdit" data-id="' + data +
                                '" type="button" class="btn btn-warning btn-sm btnEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></button>';
                        }
                        return btnTambah + btnEdit;
                    },
                },
            ]
        });

        function reloadTable() {
            myTable.ajax.reload(null, false); //reload datatable ajax
        }

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            var isValid = $("#laporanForm").valid();
            if (isValid) {
                $('#saveBtn').text('Save...');
                $('#saveBtn').attr('disabled', true);
                if (!isUpdate) {
                    var url = "{{ route('laporan/store') }}";
                } else {
                    var url = "{{ route('laporan/update') }}";
                }
                var formData = new FormData($('#laporanForm')[0]);
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
                        $('#myModal').modal('hide');
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

        $('#myTable').on("click", ".btnTambah", function() {
            $('#myModal').modal('show');
            isUpdate = false;
            var id = $(this).attr('data-id');
            var url = "{{ route('laporan/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
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

        $('#myTable').on("click", ".btnEdit", function() {
            $('#editModal').modal('show');
            isUpdate = true;
            var id = $(this).attr('data-id');
            var url = "{{ route('laporan/showing', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#name_file').val(response.data.name_file);
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
    });
</script>
@endpush
