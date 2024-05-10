@extends('pages.layouts.master')
@section('content')
@section('title', 'Nota Dinas')

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


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Nota Dinas</h4>
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
                    <a href="#">Surat Pre-Perjalanan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Notas Dinas</a>
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
                            <table id="myTable" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>Nomor Nota Dinas</th>
                                        <th>MAK</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Maksud Perjalanan/Kegiatan</th>
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
                "url": "{{ route('nota-dinas/getData') }}",
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
            "columns": [
                {
                    "data": "nota_dinas",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.nomor_nota_dinas) {
                            return "<div class='text-wrap badge badge-success'>" + data.nomor_nota_dinas + "</div>";
                        } else {
                            return "<div class='text-wrap badge badge-danger'>Belum ada berkas</div>";
                        }
                    }
                },
                {
                    "data": "mak",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            if (data && data.kode_mak) {
                                return "<div class='text-wrap' style='font-size: 12px;'>" + data.kode_mak + "</div>";
                            } else {
                                return "<div class='text-wrap'>-</div>";
                            }
                        }
                },
                {
                        "data": "tujuan",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            console.log(data);
                            var tujuan = "";
                            var angka = 1;
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].status === 1) {

                                tujuan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + data[i].tempat_tujuan.name + "</div>";
                                angka++;
                                }
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
                    "data": "tujuan",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            var tujuan = "";
                            var angka = 1;
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].status === 1) {
                                tujuan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + formatIndonesianDate(data[i].tanggal_berangkat) + "</div>";
                                angka++;
                                }
                            }
                            return tujuan;
                            // if (data && data.tanggal_berangkat) {
                            //     return "<div class='text-wrap'>" + data.tanggal_berangkat + "</div>";
                            // } else {
                            //     return "<div class='text-wrap'>-</div>";
                            // }
                        }

                },
                {

                    "data": "tujuan",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            var tujuan = "";
                            var angka = 1;
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].status === 1) {
                                tujuan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + formatIndonesianDate(data[i].tanggal_pulang) + "</div>";
                                angka++;
                                }
                            }
                            return tujuan;
                            // if (data && data.tanggal_pulang) {
                            //     return "<div class='text-wrap'>" + data.tanggal_pulang + "</div>";
                            // } else {
                            //     return "<div class='text-wrap'>-</div>";
                            // }
                        }
                },
                {
                "data": "kegiatan",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        var kegiatan = "";
                        var angka = 1;
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].status === 1) {
                            kegiatan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + data[i].kegiatan + "</div>";
                            angka++;
                            }
                        }
                        return kegiatan;
                        // if (data && data.tanggal_pulang) {
                        //     return "<div class='text-wrap'>" + data.tanggal_pulang + "</div>";
                        // } else {
                        //     return "<div class='text-wrap'>-</div>";
                        // }
                    }
                },
                {
                    "data": "id",
                    "width": '15%',
                    render: function(data, type, row) {
                        var btnTambah = "";
                        var btnDownload = "";
                        var btnEdit = "";
                        var btnDelete = "";

                        //if tujuam modal id is empty
                            if (row.nota_dinas == null) {
                                btnTambah += '<a href="/nota-dinas/create/' + data +
                                    '" name="btnTambah" data-id="' + data +
                                    '" type="button" class="btn btn-primary btn-sm btnTambah m-1" data-toggle="tooltip" data-placement="top" title="Tambah"><i class="fa fa-plus"></i></a>';
                            } else if (row.nota_dinas != null) {
                                btnEdit += '<a href="/nota-dinas/edit/' + data +
                                    '" name="btnEdit" data-id="' + data +
                                    '" type="button" class="btn btn-warning btn-sm btnEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></a>';

                                btnDownload += '<a href="/nota-dinas/pdf/' + data +
                                    '" name="btnDownload" data-id="' + data +
                                    '" type="button" class="btn btn-success btn-sm btnDownload m-1" data-toggle="tooltip" data-placement="top" title="Download"><i class="fa fa-download"></i></a>';
                            }




                            // btnDelete += '<a href="#" name="btnDelete" data-id="' + data +
                            //     '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>';

                            // console.log(row);
                        return btnTambah + btnEdit + btnDownload + btnDelete;
                    },
                },
            ]
        });

        function reloadTable() {
            myTable.ajax.reload(null, false); //reload datatable ajax
        }

        $('#myTable').on("click", ".btnStatus", function() {
                isUpdate = true;
                var id = $(this).attr('data-id');
                var url = "{{ route('statusPerjalanan/show', ['id' => ':id']) }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        $('#id').val(response.data.id);
                        $('#status').val(response.data.id_status_perjalanan);
                        $('#myModal').modal('show');
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

        $('#myTable').on("click", ".btnDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "You will delete this pengajuan. Are you sure you want to continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, I'm sure",
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('dataPerjalanan/delete', ['id' => ':id']) }}";
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
    });
</script>

@endpush







