@extends('pages.layouts.master')
@section('content')
@section('title', 'Geo Tagging')

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
			<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" >
					<div class="modal-content">
						<div class="modal-header border-0" id="myModalLabel">
							<h5 class="modal-title">
								<span class="fw-mediumbold">
								Data</span>
								<span class="fw-light">
									Geo Tagging
								</span>
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('jabatan/store') }}" id="jabatanForm" name="jabatanForm">
                                @csrf
                                <input id="id" type="hidden" class="form-control" name="id">
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Geo Tagging<span
                                            style="color:red;">*</span></label>
                                    <div class="col-sm-9 validate">
                                        <input id="name" type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="description" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9 validate">
                                        <textarea class="form-control" rows="3" id="description" name="description"></textarea>
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
						<h4 class="page-title">Geo Tagging</h4>
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
								<a href="#">Surat Pra Perjalanan</a>
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
								<a href="#">Geo Tagging</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										{{-- <h4 class="card-title">Data Jabatan</h4> --}}
                                        {{-- <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                            data-toggle="modal" data-target="#myModal" id="addNew" name="addNew"><i class="fa fa-plus"></i> Tambah Jabatan</a> --}}
                                            {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                            <i class="fa fa-plus"></i>Create
                                            </button> --}}
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="geoTable" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kegiatan</th>
                                                    <th>Nama</th>
                                                    <th>Tujuan</th>
                                                    <th>Tanggal</th>
                                                    <th>Tahun</th>
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

        var geoTable = $('#geoTable').DataTable({
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
                "url": "{{ route('geo-tagging/getData') }}",
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
                    "data": "staff",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.name) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data.name + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
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
                            return "<div class='text-wrap' style='font-size: 12px;'>" + data[0].tempat_tujuan.name + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {

                    "data": "tujuan_perjalanan",
                    "width": '30%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap' style='font-size: 12px;'>" + formatIndonesianDate(data[0].tanggal_berangkat) + " - " + formatIndonesianDate(data[0].tanggal_pulang) + "</div>";
                        } else {
                            return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                        }
                    }
                },
                {
                    "data": "created_at",
                    "width": '5%',
                    "defaultContent": "-",
                     //render date format
                    render: function(data, type, row) {
                       //return year center
                        return "<div class='text-wrap' style='font-size: 12px;'>" + data.substring(0, 4) + "</div>";
                    }
                },
                {
                    "data": "perjalanan",
                    "width": '15%',
                    "defaultContent": "-",
                     //render date format
                    render: function(data, type, row) {
                        if (row.geotaging == "" || row.geotaging == null) {
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
                        var btnView = "";
                        var baseUrl = getBaseUrl();

                        // Check if geotaging data is available
                        if (row.geotaging == "" || row.geotaging == null) {
                            btnTambah += '<a href="' + baseUrl + '/geo-tagging/' + data +
                                '" name="btnTambah" data-id="' + data +
                                '" type="button" class="btn btn-primary btn-sm btnTambah m-1" data-toggle="tooltip" data-placement="top" title="Tambah"><i class="fas fa-file-image"></i></a>';
                        } else {
                            btnView += '<a href="' + baseUrl + '/geo-tagging/view/' + row.geotaging[0].id +
                                '" name="btnView" data-id="' + data +
                                '" type="button" class="btn btn-success btn-sm btnView m-1" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-eye"></i></a>';
                        }

                        return btnTambah + btnView;
                    },
                },
            ]
        });

        function reloadTable() {
            geoTable.ajax.reload(null, false); //reload datatable ajax
        }

        $('#geoTable').on("click", ".btnStatus", function() {
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

        $('#geoTable').on("click", ".btnDelete", function() {
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







