@extends('pages.layouts.master')
@section('content')
@section('title', 'Kartu Kredit Pemerintah')
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


<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header border-0" id="myModalLabel">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Form</span>
                    <span class="fw-light">
                        Change Status
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('statusPerjalanan/update') }}" id="statusForm" name="statusForm">
                    @csrf
                    <input id="id" type="hidden" class="form-control" name="id">
                    <div class="row mb-4">
                        <label for="name" class="col-sm-3 col-form-label">Status<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <select class="form-control" id="status" name="status">
                                <option value="">-- Pilih Status --</option>
                                {{-- @foreach ($statusPerjalanan as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" onclick="$('#myModal form').submit()"
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
            <h4 class="page-title">Kartu Kredit Pemerintah</h4>
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
                    <a href="#">KKP</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>MAK</th>
                                        <th>Kegiatan</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Tanggal Kembali</th>
                                        {{-- <th>Estimasi Biaya</th> --}}
                                        <th>Status</th>
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
                "url": "{{ route('dataPerjalanan/getData/rekap') }}",
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
                            "data": "kegiatan",
                            "width": '10%',
                            "defaultContent": "-",
                            "render": function(data, type, row) {
                                console.log(data);
                                var kegiatan = "";
                                var angka = 1;
                                for (var i = 0; i < data.length; i++) {
                                    if (data[i].status === 1) {
                                        kegiatan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + data[i].kegiatan + "</div>";
                                        angka++;
                                    }
                                }
                                return kegiatan || "-";
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
                                tujuan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + data[i].tempat_tujuan.name + "</div>";
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
                        "data": "tujuan",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            var tujuan = "";
                            var angka = 1;
                            for (var i = 0; i < data.length; i++) {
                                tujuan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + formatIndonesianDate(data[i].tanggal_berangkat) + "</div>";
                                angka++;
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
                                tujuan += "<div class='text-wrap' style='font-size: 12px;'>" + angka + ". " + formatIndonesianDate(data[i].tanggal_pulang) + "</div>";
                                angka++;
                            }
                            return tujuan;
                            // if (data && data.tanggal_pulang) {
                            //     return "<div class='text-wrap'>" + data.tanggal_pulang + "</div>";
                            // } else {
                            //     return "<div class='text-wrap'>-</div>";
                            // }
                        }
                    },
                    // {
                    //     "data": "estimasi_biaya",
                    //     "width": '10%',
                    //     "defaultContent": "-",
                    //     render: function(data, type, row) {
                    //         //get the function formatRupiah on Helpers.php
                    //         return "<div class='text-wrap' style='font-size: 12px;'>Rp. " + rupiah(data) + "</div>";
                    //     },
                    // },
                    {
                        "data": "status_perjalanan",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            return "<div class='text-wrap' style='font-size: 12px;'>Active</div>";
                        },

                    },
                {
                    "data": "id",
                    "width": '15%',
                    render: function(data, type, row) {
                        var btnDetail = "";
                        btnDetail += '<a href="/kkp-detail/' + data +
                                    '" name="btnEdit" data-id="' + data +
                                    '" type="button" class="btn btn-warning btn-sm btnDetailStatus m-1" data-toggle="tooltip" data-placement="top" title="Detail Status"><i class="fa fa-bookmark"></i></a>';
                        return btnDetail;
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







