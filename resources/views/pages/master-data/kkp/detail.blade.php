@extends('pages.layouts.master')
@section('content')
@section('title', 'Detail Kartu Kredit Pemerintah')
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
            <h4 class="page-title">Detail Kartu Kredit Pemerintah</h4>
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
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Golongan</th>
                                        <th>Jabatan</th>
                                        <th>Tujuan</th>
                                        <th>Estimasi Biaya</th>
                                        <th>Tanggal</th>
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
                "url": "{{ route('kkp-detail/getData', ['id' => $id_detail]) }}",
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
                        "data": null,
                        "width": '5%',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        // "data": "perihal_perjalanan",
                        // "width": '10%',
                        // "defaultContent": "-",
                        // render: function(data, type, row) {
                        //     return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                        // },

                        "data": "staff.name",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                        }
                    },
                    {
                        "data": "staff.golongans",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            if (data) {
                                return "<div class='text-wrap' style='font-size: 12px;'>" + data.name + "</div>";
                            } else {
                                return "<div class='text-wrap'>-</div>";
                            }
                        }
                    },
                    {
                        "data": "staff.jabatans",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            if (data) {
                                return "<div class='text-wrap' style='font-size: 12px;'>" + data.name + "</div>";
                            } else {
                                return "<div class='text-wrap'>-</div>";
                            }
                        }
                    },
                    {
                        "data": "tujuan_perjalanan",
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
                        "data": null,
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            let golongan = row.staff.golongans.id
                            let lama_perjalanan = row.tujuan_perjalanan[0].lama_perjalanan
                            let hotel = row.tujuan_perjalanan[0].tempat_tujuan.hotel
                            let tiket = row.tujuan_perjalanan[0].tempat_tujuan.tiket
                            let translok = row.tujuan_perjalanan[0].tempat_tujuan.translok
                            const filteredHotel = hotel.filter(item => item.id_golongan === golongan);
                            const filteredTiket = tiket.filter(item => item.id_golongan === golongan);
                            const filteredTranslok = translok.filter(item => item.id_golongan === golongan);
                            if (data) {
                                // Tambahkan Data Lain Disini (data hotel, tiket, transportasi)
                                // return "<div class='text-wrap'>" + filteredTranslok[0].nominal + "</div>";
                                return "<div class='text-wrap'>" + 'Rp. ' + rupiah((parseInt(filteredHotel[0].nominal*(lama_perjalanan-1)) + parseInt(filteredTiket[0].nominal) + parseInt(filteredTranslok[0].nominal))) + "</div>";
                            } else {
                                return "<div class='text-wrap'>-</div>";
                            }
                        }
                    },
                    {
                        "data": "tujuan_perjalanan",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            if (data) {
                                return "<div class='text-wrap'>" + formatIndonesianDate(data[0].tanggal_berangkat) + " - " + formatIndonesianDate(data[0].tanggal_pulang) + "</div>";
                            } else {
                                return "<div class='text-wrap'>-</div>";
                            }
                        }
                    },
                    {
                        "data": "id",
                        "width": '15%',
                        render: function(data, type, row) {
                            var btnDetail = "";
                            btnDetail += '<a href="/kkp/pdf/' + data +
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

        // $('#myTable').on("click", ".btnStatus", function() {
        //         isUpdate = true;
        //         var id = $(this).attr('data-id');
        //         var url = "{{ route('statusPerjalanan/show', ['id' => ':id']) }}";
        //         url = url.replace(':id', id);
        //         $.ajax({
        //             type: 'GET',
        //             url: url,
        //             success: function(response) {
        //                 $('#id').val(response.data.id);
        //                 $('#status').val(response.data.id_status_perjalanan);
        //                 $('#myModal').modal('show');
        //             },
        //             error: function() {
        //                 Swal.fire(
        //                     'Error',
        //                     'A system error has occurred. please try again later.',
        //                     'error'
        //                 )
        //             },
        //         });
        // });

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
