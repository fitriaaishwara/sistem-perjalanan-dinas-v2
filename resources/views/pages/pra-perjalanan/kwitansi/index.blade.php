@extends('pages.layouts.master')
@section('content')
@section('title', 'Kwitansi')

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
            <h4 class="page-title">Kwitansi</h4>
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
                    <a href="#">Kwitansi</a>
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
                                        <th>NIP/NIK</th>
                                        <th>Nama</th>
                                        <th>Kegiatan</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal</th>
                                        <th>Total Diterima</th>
                                        <th>Total Biaya Perjalanan</th>
                                        <th>Total Uang Harian</th>
                                        {{-- <th>Total Diterima</th> --}}
                                        <th>Tahun Anggaran</th>
                                        <th>Kode MAK</th>
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
 function getBaseUrl() {
    return "https://survei.kemenkopukm.go.id/perjadin"; // Ganti dengan base URL Anda
}
    function rupiah($angka) {
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
                "url": "{{ route('kwitansi/getData') }}",
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
                    "data": "staff",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.nip) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data
                                .nip + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }
                },
                {
                    "data": "staff",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.name) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data
                                .name + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }
                },
                {
                    "data": "perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    "render": function(data, type, row) {
                        if (data && data[0] && data[0].kegiatan) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data[0].kegiatan[0].kegiatan + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {
                    "data": "tujuan_perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        //name
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data[0]
                                .tempat_tujuan.name + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {

                    "data": "tujuan_perjalanan",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" +
                                formatIndonesianDate(data[0].tanggal_berangkat) + " - " +
                                formatIndonesianDate(data[0].tanggal_pulang) + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {
                    "data": "tujuan_perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    //render date format
                    render: function(data, type, row) {
                        if (data) {
                            const transportBerangkat = parseInt(row.transportasi_berangkat[0]?.nominal ?? 0);
                            const transportPulang = parseInt(row.transportasi_pulang[0]?.nominal ?? 0);
                            const akomodasiHotel = parseInt(row.akomodasi_hotel[0]?.nominal ?? 0) * (row.tujuan_perjalanan[0].lama_perjalanan - 1);
                            const uangHarian = parseInt(row.tujuan_perjalanan[0].uang_harian.nominal ?? 0) * row.tujuan_perjalanan[0].lama_perjalanan;

                            const total = transportBerangkat + transportPulang + akomodasiHotel + uangHarian;

                            return "<div class='text-wrap' style='font-size: 12px;'>Rp. " +
                                rupiah(total) +
                                "</div>";
                        } else {
                            return "<div class='text-wrap badge badge-danger' style='font-size: 12px;'>Belum Upload Invoice</div>";
                        }
                    }
                },
                {
                    "data": "tujuan_perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    //render date format
                    render: function(data, type, row) {
                        if (data) {
                            const total =
                            parseInt(row.transportasi_berangkat[0]?.nominal ?? 0) +
                            parseInt(row.transportasi_pulang[0]?.nominal ?? 0) +
                            (parseInt(row.akomodasi_hotel[0]?.nominal ?? 0) * (row.tujuan_perjalanan[0].lama_perjalanan - 1));
                            return "<div class='text-wrap' style='font-size: 12px;'>Rp. " +
                                rupiah(total)
                                "</div>";
                        } else {
                            return "<div class='text-wrap badge badge-danger' style='font-size: 12px;'>Belum Upload Invoce</div>";
                        }
                    }
                },
                {

                    "data": "tujuan_perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    //render date format
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>Rp. " +
                                rupiah(data[0].uang_harian.nominal * data[0].lama_perjalanan) +
                                "</div>";
                        } else {
                            return "<div class='text-wrap badge badge-danger' style='font-size: 12px;'>Belum Upload Invoce</div>";
                        }
                    }
                },
                {
                    "data": "kwitansi",

                    "data": "created_at",

                    "width": '15%',
                    "defaultContent": "-",
                    //render date format
                    render: function(data, type, row) {
                        //return year center
                        return "<div class='text-wrap' style='font-size: 12px;'>" + data
                            .substring(0, 4) + "</div>";
                    }
                },
                {
                    "data": "perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    //render date format
                    render: function(data, type, row) {
                        var result = "<div class='text-wrap' style='font-size: 12px;'>";
                        $.each(data, function(key, val) {
                            // console.log(val);
                            result += val.mak.kode_mak + "<br>";
                        });

                        result += "</div>";
                        return result;
                    }
                },
                {
                    "data": "perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                    //render date format
                    render: function(data, type, row) {
                        if (row.kwitansi == "" || row.kwitansi == null) {
                            return "<div class='text-wrap badge badge-danger' style='font-size: 12px;'>Belum Dibuat</div>";
                        } else {
                            return "<div class='text-wrap badge badge-success' style='font-size: 12px;'>Terlampir</div>";
                        }
                    }
                },
                {
                    "data": "id",
                    "width": '15%',
                    render: function(data, type, row) {
                        var btnTambah = "";
                        var btnDownload = "";
                        var btnDownloadTtd = "";
                        // var btnEdit = "";
                        var btnDetail= "";
                        var btnTambahInvoice="";
                        var baseUrl = getBaseUrl();
                        var btnDetail = "";

                        if (row.kwitansi == "" || row.kwitansi == null) {
                            @if (auth()->check() && auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                            btnTambah += '<a href="' + baseUrl + '/kwitansi/create/' + data +
                                '" name="btnTambah" data-id="' + data +
                                '" type="button" class="btn btn-primary btn-sm btnTambah m-1" data-toggle="tooltip" data-placement="top" title="Tambah"><i class="fa fa-plus"></i></a>';
                            // btnTambah += '<a href="/kwitansi/create/' + data +
                            //     '" name="btnTambah" data-id="' + data +
                            //     '" type="button" class="btn btn-primary btn-sm btnTambah m-1" data-toggle="tooltip" data-placement="top" title="Tambah"><i class="fa fa-plus"></i></a>';
                            @endif
                        } else if (row.kwitansi && row.kwitansi != "") {
                        @if (auth()->check() && auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                            btnDetail += '<a href="' + baseUrl + '/kwitansi/' + row.id +
                                '" name="btnDetail" data-id="' + row.id +
                                '" type="button" class="btn btn-info btn-sm btnDetail m-1" data-toggle="tooltip" data-placement="top" title="Detail Status"><i class="fa fa-eye"></i></a>';
                            @endif
                        }

                        @if (auth()->check() && auth()->user()->hasAnyRole(['Staff']))
                            // Cek apakah data.spd ada dan panjangnya lebih dari 0
                            if (row.kwitansi && row.kwitansi.length > 0) {
                                var kwitansiId = row.spd[0].id; // Ambil id dari elemen pertama dalam array spd

                                // Buat tombol unduh untuk TTD
                                btnDownloadTtd += '<a href="' + baseUrl + '/kwitansi/downloadttd/' + kwitansiId + '" name="btnDownloadTtd" data-id="' + kwitansiId + '" type="button" class="btn btn-primary btn-sm btnDownloadTtd m-1" data-toggle="tooltip" data-placement="top" title="Download"><i class="fa fa-download"></i></a>';
                            } else {

                                //badge spd belum di tandatangani
                                btnDownloadTtd += '<span class="badge badge-danger">Kwitansi belum ditandatangani</span><br>';

                                // btnDownload += '<a href="' + baseUrl + '/kwitansi/pdf/' + data +
                                // '" name="btnDownload" data-id="' + data +
                                // '" type="button" class="btn btn-success btn-sm btnDownload m-1" data-toggle="tooltip" data-placement="top" title="Download Draft">Download Draft</a>';

                            }
                        @endif

                        console.log(row);
                        return btnTambah + btnDetail + btnTambahInvoice  + btnDownloadTtd + btnDownload;
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
