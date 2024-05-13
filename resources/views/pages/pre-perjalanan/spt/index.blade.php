@extends('pages.layouts.master')
@section('content')
@section('title', 'Surat Perintah Tugas')

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
            <h4 class="page-title">Surat Perintah Tugas</h4>
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
                    <a href="#">Surat Perintah Tugas</a>
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
                                        <th>Nomor SPT</th>
                                        <th>Diperintahkan Kepada</th>
                                        <th>Maksud Perjalanan / Kegiatan</th>
                                        <th>Tujuan</th>
                                        <th>Jangka Waktu</th>
                                        <th>Dikeluarkan</th>
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
                "url": "{{ route('spt/getData') }}",
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
                    "data": "spt",
                    "width": '20%',
                    "defaultContent": "-",
                    "render": function(data, type, row) {
                        if (data && data.length > 0) {
                            return "<div class='text-wrap badge badge-success'>" + data[0].nomor_spt + "</div>";
                        } else {
                            return "<div class='text-wrap badge badge-danger'>Belum ada berkas</div>";
                        }
                    }
                },
                {
                    "data": "data_kegiatan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        var result = "<div class='text-wrap' style='font-size: 12px;'>";
                        $.each(data, function(index, value) {
                            result += (index + 1) + ". " + value.staff.name + "<br>";
                        });
                        result += "</div>";
                        return result;
                    }
                },
                {
                    "data": "kegiatan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {
                    "data": "perjalanan.tujuan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.length > 0) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data[0].tempat_tujuan.name + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {
                    "data": "perjalanan.tujuan",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.length > 0) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + formatIndonesianDate(data[0].tanggal_berangkat) + " s/d " + formatIndonesianDate(data[0].tanggal_pulang) + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'> - </div>";
                        }
                    }
                },
                {
                    "data": "id",
                    "width": '15%',
                    "defaultContent": "-",
                     //render date format
                    render: function(data, type, row) {
                        if (data == "" || data == null) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + moment(data).format('DD MMM YYYY') + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>Belum Diterbitkan</div>";
                        }
                    }
                },
                {
                    "data": "id",
                    "width": '15%',
                    render: function(data, type, row) {
                        var btnTambah = "";
                        var btnDetail = "";
                        var btnEdit = "";

                        if (row.perjalanan.tujuan.length > 0) {
                            row.perjalanan.tujuan.forEach(function(tujuan) {
                                if (!tujuan.spt || tujuan.spt.length === 0) {
                                    btnTambah += '<a href="/surat-perintah-tugas/create/' + tujuan.id +
                                        '" name="btnTambah" data-id="' + tujuan.id +
                                        '" type="button" class="btn btn-primary btn-sm btnTambah m-1" data-toggle="tooltip" data-placement="top" title="Tambah"><i class="fa fa-plus"></i></a>';
                                } else {
                                    btnDetail += '<a href="/surat-perintah-tugas/' + tujuan.id +
                                        '" name="btnDetail" data-id="' + tujuan.id +
                                        '" type="button" class="btn btn-warning btn-sm btnDetail m-1" data-toggle="tooltip" data-placement="top" title="Detail Status"><i class="fa fa-bookmark"></i></a>';
                                }
                            });
                        }

                        console.log(row);
                        return btnTambah + btnDetail;
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







