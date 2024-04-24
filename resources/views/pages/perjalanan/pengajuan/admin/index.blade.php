@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Pengajuan')
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


<div id="myModalStatus" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalStatusLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header border-0" id="myModalStatusLabel">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Form</span>
                    <span class="fw-light">
                        Ubah Status
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('statusPerjalanan/store') }}" id="statusForm" name="statusForm">
                    @csrf
                    <input id="id" type="hidden" class="form-control" name="id_perjalanan">
                    <div class="mb-3 validate">
                        <label for="status_perjalanan" class="form-label">Status Perjalanan<span
                                style="color:red;">*</span>
                        </label>
                        <select id="status_perjalanan" type="text" class="form-control col-12 status_perjalanan"
                        name="status_perjalanan">
                            <option value=""></option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Belum Disetujui">Belum Disetujui</option>
                        </select>
                    </div>
                    <div class="mb-3 validate">
                        <label for="description" class="form-label">Deskripsi Revisi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3 validate">
                        <label for="direvisi_oleh" class="form-label">Direvisi Oleh<span
                                style="color:red;">*</span>
                        </label>
                        <select id="direvisi_oleh" type="text" class="form-control col-12 direvisi_oleh"
                        name="direvisi_oleh">
                            <option value=""></option>
                            <option value="Asisten Deputi Pemetaan Data dan Analis Usaha">Asisten Deputi Pemetaan Data dan Analis Usaha</option>
                            <option value="Kepala Bidang Pemetaan Data">Kepala Bidang Pemetaan Data</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtnStatus"
                    name="saveBtnStatus">Save changes</button>
                <button type="button" class="btn btn-secondary waves-effect btn-sm"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Pengajuan Perjalanan</h4>
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
                    <a href="#">Perjalanan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Pengajuan Perjalanan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            {{-- <h4 class="card-title">Data Jabatan</h4> --}}
                            <a href="{{ route('pengajuan/create') }}" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i> Add Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pengajuanTable" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>MAK</th>
                                        <th>Perihal</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Estimasi Biaya</th>
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

                var pengajuanTable = $('#pengajuanTable').DataTable({
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
                        "url": "{{ route('pengajuan/getData') }}",
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
                            "data": "perihal_perjalanan",
                            "width": '10%',
                            "defaultContent": "-",
                            render: function(data, type, row) {
                                return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                            },
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
                        {
                            "data": "estimasi_biaya",
                            "width": '10%',
                            "defaultContent": "-",
                            render: function(data, type, row) {
                            //format_rupiah
                            return "<div class='text-wrap' style='font-size: 12px;'>Rp. " + rupiah(data) + "</div>";
                            },
                        },
                        {
                            "data": "id",
                            "width": '10%',
                            "defaultContent": "-",
                            render: function(data, type, row) {
                                var btnStatusPerjalanan = "";
                                var btnDetailStatus = "";

                                @if (auth()->user()->can('asdep', 'kabid'))
                                btnStatusPerjalanan += '<button name="btnStatusPerjalanan" data-id="' + data +
                                    '" type="button" class="btn btn-dark btn-sm btnStatusPerjalanan m-1" data-toggle="tooltip" data-placement="top" title="Ubah Status"><i class="fa fa-pen"></i></button>';
                                btnDetailStatus += '<a href="/detail-status/' + data +
                                    '" name="btnEdit" data-id="' + data +
                                    '" type="button" class="btn btn-warning btn-sm btnDetailStatus m-1" data-toggle="tooltip" data-placement="top" title="Detail Status"><i class="fa fa-pen"></i></a>';
                                @endif

                            //    // status terbaru default adalah "-"
                            //     var latestStatus = "Belum Direview";

                            //     // jika log_status_perjalanan tidak null dan memiliki panjang lebih dari 0, maka ambil status_perjalanan dari indeks terakhir log_status_perjalanan
                            //     if (row.log_status_perjalanan && row.log_status_perjalanan.length > 0) {
                            //         var lastStatus = row.log_status_perjalanan[row.log_status_perjalanan.length - 1].status_perjalanan;
                            //     }

                            //     // Kembalikan latestStatus bersama dengan tombol
                            //     return "<div class='text-wrap' style='font-size: 12px;'>" + latestStatus + "</div>" + btnStatusPerjalanan + btnDetailStatus;

                            // Inisialisasi objek untuk menyimpan status per ID perjalanan
                            var latestStatus = "Belum Direview";
                            var latestStatusId = 0;

                            // Jika log_status_perjalanan tidak null dan memiliki panjang lebih dari 0, maka ambil status_perjalanan dari indeks terakhir log_status_perjalanan
                            if (row.log_status_perjalanan && row.log_status_perjalanan.length > 0) {
                                latestStatus = row.log_status_perjalanan[row.log_status_perjalanan.length - 1].status_perjalanan;
                                latestStatusId = row.log_status_perjalanan[row.log_status_perjalanan.length - 1].id;
                            }

                            // Kembalikan latestStatus bersama dengan tombol
                            return "<div class='text-wrap' style='font-size: 12px;'>" + latestStatus + "</div>" + btnStatusPerjalanan + btnDetailStatus;

                            },
                        },
                    {
                        "data": "id",
                        "width": '15%',
                        render: function(data, type, row) {
                            var btnEdit = "";
                            var btnStatus = "";
                            var btnDelete = "";
                            btnEdit += '<a href="/pengajuan/edit/' + data +
                                '" name="btnEdit" data-id="' + data +
                                '" type="button" class="btn btn-warning btn-sm btnEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></a>';
                            btnStatus += '<button name="btnStatus" data-id="' + data +
                                '" type="button" class="btn btn-primary btn-sm btnStatus m-1" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa fa-bookmark"></i></button>';
                            @if (auth()->user()->can('superadmin'))
                            btnDelete += '<button name="btnDelete" data-id="' + data +
                                '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';
                            @endif
                            return btnEdit + btnStatus + btnDelete;
                        },
                    },
                ]
            });

            function reloadTable() {
                pengajuanTable.ajax.reload(null, false); //reload datatable ajax
                location.reload(); // Reload the page
            }

            $("#status_perjalanan").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModalStatus'),
            placeholder: "Pilih Status",
            })

            $("#direvisi_oleh").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModalStatus'),
            placeholder: "Pilih Status",
            })

            $('#saveBtnStatus').click(function(e) {
                e.preventDefault();
                var isValid = $("#statusForm").valid();
                if (isValid) {
                    $('#saveBtnStatus').text('Save...');
                    $('#saveBtnStatus').attr('disabled', true);
                    var url = "{{ route('statusPerjalanan/store') }}";
                    var formData = new FormData($('#statusForm')[0]);
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
                            $('#saveBtnStatus').text('Save');
                            $('#saveBtnStatus').attr('disabled', false);
                            reloadTable();
                            $('#myModalStatus').modal('hide');
                        },
                        error: function(data) {
                            Swal.fire(
                                'Error',
                                'A system error has occurred. please try again later.',
                                'error'
                            )
                            $('#saveBtnStatus').text('Save');
                            $('#saveBtnStatus').attr('disabled', false);
                        }
                    });
                }
            });

            $('#pengajuanTable').on("click", ".btnStatusPerjalanan", function() {
                $('#myModalStatus').modal('show');
                isUpdate = false;
                var id = $(this).attr('data-id');
                var url = "{{ route('statusPerjalanan/show', ':id') }}";
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

            $('#pengajuanTable').on("click", ".btnDelete", function() {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Confirmation',
                    text: "Kamu akan menghapus pengajuan. Apakah kamu ingin melanjutkan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, I'm sure",
                    cancelButtonText: 'No'
                }).then(function(result) {
                    if (result.value) {
                        var url = "{{ route('pengajuan/delete', ['id' => ':id']) }}";
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

            $('#statusForm').validate({
            rules: {
                status_perjalanan: {
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
        });
    </script>
@endpush







