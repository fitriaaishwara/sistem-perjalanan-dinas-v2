@extends('pages.layouts.master')
@section('content')
@section('title', 'Data SBM Tiket')

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
                    <span class="fw-mediumbold">Data</span>
                    <span class="fw-light">Uang Harian</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('sbm-tiket/store') }}" id="tiketForm" name="tiketForm">
                    @csrf
                    <input id="id" type="text" class="form-control" name="id">
                    <div class="row mb-4">
                        <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                        <div class="col-sm-9 validate">
                            <input class="form-control" id="nominal" name="nominal">
                            <small id="formatted_nominal" class="form-text text-muted"></small>
                            <small id="notification" class="text-muted"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtn" name="saveBtn">Save changes</button>
                <button type="button" class="btn btn-secondary waves-effect btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

			<div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">SBM Tiket</h4>
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
								<a href="#">Uang Harian</a>
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
                                            data-toggle="modal" data-target="#myModal" id="addNew" name="addNew"><i class="fa fa-plus"></i> Tambah Uang Harian</a> --}}
                                            {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                            <i class="fa fa-plus"></i>Create
                                            </button> --}}
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="tiketTable" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Provinsi</th>
                                                    <th>Golongan</th>
                                                    <th>Nominal</th>
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
<script>
    document.getElementById('nominal').addEventListener('input', function (e) {
        let nominal = e.target.value;

        // Remove non-numeric characters
        nominal = nominal.replace(/\D/g, '');

        // Limit the length of nominal
        if (nominal.length > 9) {
            nominal = nominal.substring(0, 9);
        }

        // Format the nominal
        const formattedNominal = formatCurrency(nominal);

        // Set the formatted nominal below the form
        document.getElementById('formatted_nominal').textContent = formattedNominal;

        // Set the value in the input field
        e.target.value = nominal;

        // Update the validation message
        updateValidationMessage(nominal);
    });

    function formatCurrency(amount) {
        if (!amount) return '';

        // Convert to currency format Rp 300.000
        return 'Rp ' + Number(amount).toLocaleString('id-ID');
    }

    // Validate only numbers
    document.getElementById('nominal').addEventListener('keypress', function (e) {
        const keyCode = e.keyCode;
        if (keyCode < 48 || keyCode > 57) {
            e.preventDefault();
        }
    });

    // Update the validation message
    function updateValidationMessage(nominal) {
        const notification = document.getElementById('notification');
        if (nominal !== '') {
            if (!/^\d+$/.test(nominal)) {
                notification.textContent = 'Nominal harus berupa angka';
            } else {
                notification.textContent = '';
            }
        } else {
            notification.textContent = '';
        }
    }
</script>
    <script type="text/javascript">
        $(function() {
            let request = {
                start: 0,
                length: 10
            };
            var isUpdate = false;

            var tiketTable = $('#tiketTable').DataTable({
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
                    "url": "{{ route('sbm-tiket/getData') }}",
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
                        "data": "province.name",
                        "width": '30%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            let province = (data) ? data : '-';
                            return "<div class='text-wrap' style='font-size: 12px;'>" + province + "</div>";
                        }
                    },
                    {
                        "data": "golongan.name",
                        "width": '30%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            let province = (data) ? data : '-';
                            return "<div class='text-wrap' style='font-size: 12px;'>" + province + "</div>";
                        }
                    },
                    {
                        "data": "nominal",
                        "width": '30%',
                        "defaultContent": "-",
                        render: function(data, type, row) {
                            let nominal = (data) ? data : '-';
                            return "<div class='text-wrap' style='font-size: 12px;'>" + nominal + "</div>";
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
                            // btnDelete += '<button name="btnDelete" data-id="' + data +
                            //     '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';

                            // return btnEdit + btnDelete;
                            return btnEdit;
                        },
                    },
                ]
            });

            function reloadTable() {
                tiketTable.ajax.reload(null, false); //reload datatable ajax
            }

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var isValid = $("#tiketForm").valid();
                if (isValid) {
                    $('#saveBtn').text('Save...');
                    $('#saveBtn').attr('disabled', true);
                    if (!isUpdate) {
                        var url = "{{ route('sbm-tiket/store') }}";
                    } else {
                        var url = "{{ route('sbm-tiket/update') }}";
                    }
                    var formData = new FormData($('#tiketForm')[0]);
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

            $('#tiketTable').on("click", ".btnEdit", function() {
    $('#myModal').modal('show');
    isUpdate = true;
    var id = $(this).attr('data-id');
    var url = "{{ route('sbm-tiket/show', ['id' => ':id']) }}";
    url = url.replace(':id', id);
    $.ajax({
        type: 'GET',
        url: url,
        success: function(response) {
            $('#nominal').val(response.data.nominal); // Corrected line
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

            $('#tiketTable').on("click", ".btnDelete", function() {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Confirmation',
                    text: "Kamu akan menghapus tiket. Apakah kamu ingin melanjutkan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, I'm sure",
                    cancelButtonText: 'No'
                }).then(function(result) {
                    if (result.value) {
                        var url = "{{ route('sbm-tiket/delete', ['id' => ':id']) }}";
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

            $('#tiketForm').validate({
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
                $('#nominal').val("");
                isUpdate = false;
            });
        });
    </script>
@endpush


