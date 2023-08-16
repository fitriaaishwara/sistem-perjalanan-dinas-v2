@extends('pages.layouts.master')
@section('content')
@section('title', 'Mata Akun Anggaran')

<!-- Modal -->
			<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" >
					<div class="modal-content">
						<div class="modal-header border-0" id="myModalLabel">
							<h5 class="modal-title">
								<span class="fw-mediumbold">
								Data</span>
								<span class="fw-light">
									Mata Akun Anggaran
								</span>
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('mak/store') }}" id="makForm" name="makForm">
                                @csrf
                                <input id="id" type="hidden" class="form-control" name="id">
                                <div class="row mb-4">
                                    <label for="kode_mak" class="col-sm-3 col-form-label">Kode Mata Akun Anggaran<span
                                            style="color:red;">*</span></label>
                                    <div class="col-sm-9 validate">
                                        <input id="kode_mak" type="text" class="form-control" name="kode_mak">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="saldo_awal_pagu" class="col-sm-3 col-form-label">Saldo Awal Pagu<span
                                            style="color:red;">*</span></label>
                                    <div class="col-sm-9 validate">
                                        <input id="saldo_awal_pagu" type="text" class="form-control" name="saldo_awal_pagu">
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
						<h4 class="page-title">Kode Mata Anggaran Kegiatan</h4>
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
								<a href="#">Kode Mata Anggaran Kegiatan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										{{-- <h4 class="card-title">Data Mata Akun</h4> --}}
                                        <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                            data-toggle="modal" data-target="#myModal" id="addNew" name="addNew"><i class="fa fa-plus"></i> Tambah</a>
                                            {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                            <i class="fa fa-plus"></i>Create
                                            </button> --}}
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="makTable" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Mata Anggaran</th>
                                                    <th>Saldo Awal Pagu</th>
                                                    <th>Saldo Pagu</th>
                                                    <th>Keterangan</th>
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

            var makTable = $('#makTable').DataTable({
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
                    "url": "{{ route('mak/getData') }}",
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
                        "data": "kode_mak",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            return "<div class='text-wrap'>" + data + "</div>";
                        },
                    },
                    {
                        "data": "saldo_awal_pagu",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            return "<div class='text-wrap'>" + data + "</div>";
                        },
                    },
                    {
                        "data": "saldo_pagu",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            if (data == null) {
                                return "<div class='text-wrap'>-</div>";
                            } else {
                                return "<div class='text-wrap'>" + data + "</div>";
                            }
                        },
                    },
                    {
                        "data": "keterangan",
                        "width": '10%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            if (data == null) {
                                return "<div class='text-wrap'>-</div>";
                            } else {
                                return "<div class='text-wrap'>" + data + "</div>";
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
                makTable.ajax.reload(null, false); //reload datatable ajax
            }

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var isValid = $("#makForm").valid();
                if (isValid) {
                    $('#saveBtn').text('Save...');
                    $('#saveBtn').attr('disabled', true);
                    if (!isUpdate) {
                        var url = "{{ route('mak/store') }}";
                    } else {
                        var url = "{{ route('mak/update') }}";
                    }
                    var formData = new FormData($('#makForm')[0]);
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

            $('#makTable').on("click", ".btnEdit", function() {
                $('#myModal').modal('show');
                isUpdate = true;
                var id = $(this).attr('data-id');
                var url = "{{ route('mak/show', ['id' => ':id']) }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        $('#kode_mak').val(response.data.kode_mak);
                        $('#saldo_awal_pagu').val(response.data.saldo_awal_pagu);
                        $('#description').val(response.data.description);
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

            $('#makTable').on("click", ".btnDelete", function() {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Confirmation',
                    text: "Kamu akan menghapus Mata Akun Anggaran. Apakah kamu ingin melanjutkan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, I'm sure",
                    cancelButtonText: 'No'
                }).then(function(result) {
                    if (result.value) {
                        var url = "{{ route('mak/delete', ['id' => ':id']) }}";
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

            $('#makForm').validate({
                rules: {
                    kode_mak: {
                        required: true,
                    },
                    saldo_awal_pagu: {
                        required: true,
                    },
                    saldo_pagu: {
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
                $('#kode_mak').val("");
                $('#saldo_awal_pagu').val("");
                $('#saldo_pagu').val("");
                $('#description').val("");
                isUpdate = false;
            });
        });
    </script>
@endpush


