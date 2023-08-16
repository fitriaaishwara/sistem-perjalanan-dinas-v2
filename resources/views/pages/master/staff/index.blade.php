@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Staff')

<!-- Modal -->
			<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" >
					<div class="modal-content">
						<div class="modal-header border-0" id="myModalLabel">
							<h5 class="modal-title">
								<span class="fw-mediumbold">
								Form</span>
								<span class="fw-light">
									Staff
								</span>
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('staff/store') }}" id="staffForm" name="staffForm">
                                @csrf
                                <input id="id" type="hidden" class="form-control" name="id">
                                <div class="mb-3 validate">
                                    <label for="nip" class="form-label">NIP/NIPPPK/NIK<span
                                            style="color:red;">*</span></label>
                                    <input id="nip" type="text" class="form-control" name="nip" minlength="16" maxlength="16">
                                </div>
                                <div class="mb-3 validate">
                                    <label for="name" class="form-label">Name<span
                                            style="color:red;">*</span></label>
                                    <input id="name" type="text" class="form-control" name="name">
                                </div>
                                <div class="mb-3 validate">
                                    <label for="jenis" class="form-label">Jenis<span
                                            style="color:red;">*</span>
                                    </label>
                                    <select id="jenis" type="text" class="form-control col-12 jenis"
                                    name="jenis">
                                        <option value=""></option>
                                        <option value="0">PNS</option>
                                        <option value="1">Non PNS (PPPK)</option>
                                        <option value="2">Honorer</option>
                                        <option value="3">Lainnya</option>
                                    </select>
                                </div>
                                <div class="mb-3 validate show_in_jenis_pns_only">
                                    <label for="id_golongan" class="form-label">Golongan<span
                                            style="color:red;">*</span>
                                    </label>
                                    <select id="id_golongan" type="text" class="form-control col-12 id_golongan"
                                    name="id_golongan">
                                    </select>
                                </div>
                                <div class="mb-3 validate show_in_jenis_pns_only">
                                    <label for="id_jabatan" class="form-label">Jabatan<span
                                            style="color:red;">*</span></label>
                                    <select id="id_jabatan" type="text" class="form-control col-md-12 col-xs-12 id_jabatan"
                                        name="id_jabatan">
                                    </select>
                                </div>
                                <div class="mb-3 validate">
                                    <label for="instansi_id" class="form-label">Instansi<span
                                            style="color:red;">*</span>
                                    </label>
                                    <select id="instansi_id" type="text" class="form-control col-12 instansi_id"
                                    name="instansi_id">
                                    </select>
                                </div>
                                <div class="mb-3 validate other_instance_input">
                                    <!-- <label for="instansi" class="form-label"><span
                                            style="color:red;">*</span></label> -->
                                    <input id="instansi_other_id" type="text" class="form-control" name="instansi_other_id" placeholder="Ketikkan Instansi">
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
						<h4 class="page-title">Data Staff</h4>
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
								<a href="#">Data Staff</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										{{-- <h4 class="card-title">Staff</h4> --}}
                                        <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                            data-toggle="modal" data-target="#myModal" id="addNew" name="addNew"><i class="fa fa-plus"></i> Tambah</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="staffTable" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIP/NIPPPK/NIK</th>
                                                    <th>Nama</th>
                                                    <th>Jenis</th>
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

        var staffTable = $('#staffTable').DataTable({
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
                "url": "{{ route('staff/getData') }}",
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
                    "data": "nip",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "jenis",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if(data == 0) {
                            return "<div class='text-wrap'>PNS</div>";
                        } else if(data == 1) {
                            return "<div class='text-wrap'>Non PNS (PPPK)</div>";
                        } else {
                            return "<div class='text-wrap'>Honorer</div>";
                        }
                    },
                },
                {
                    "data": "id",
                    "width": '15%',
                    render: function(data, type, row) {
                        var btnEdit = "";
                        var btnDelete = "";
                        var btnCreate = "";
                        btnEdit += '<button name="btnEdit" data-id="' + data +
                            '" type="button" class="btn btn-warning btn-sm btnEdit m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i></button>';
                            btnCreate += '<a href="user/' + data +
                                        '/createUser" name="btnCreate" data-id="' + data +
                                        '" type="button" class="btn btn-primary btn-sm btnCreate m-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-user"></i></a>';
                            btnDelete += '<button name="btnDelete" data-id="' + data +
                            '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';
                        return btnEdit + btnCreate + btnDelete;
                    },
                },
            ]
        });

        function reloadTable() {
            staffTable.ajax.reload(null, false); //reload datatable ajax
        }
        $("#jenis").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModal'),
            placeholder: "Pilih Jenis",
        })

        $("#instansi_id").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModal'),
            placeholder: "Pilih Instansi",
            ajax: {
                url: "{{ route('instansi/getData') }}",
                dataType: 'json',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                method: 'POST',
                delay: 250,
                destroy: true,
                data: function(params) {
                    var query = {
                        searchkey: params.term || '',
                        start: 0,
                        length: 50
                    }
                    return JSON.stringify(query);
                },
                processResults: function(data) {
                    var result = {
                        results: [],
                        more: false
                    };
                    if (data && data.data) {
                        $.each(data.data, function() {
                            result.results.push({
                                id: this.id,
                                text: this.name
                            });
                        })
                    }
                    return result;
                },
                cache: false
            },
        })

        $("#id_golongan").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModal'),
            placeholder: "Pilih Golongan",
            ajax: {
                url: "{{ route('golongan/getData') }}",
                dataType: 'json',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                method: 'POST',
                delay: 250,
                destroy: true,
                data: function(params) {
                    var query = {
                        searchkey: params.term || '',
                        start: 0,
                        length: 50
                    }
                    return JSON.stringify(query);
                },
                processResults: function(data) {
                    var result = {
                        results: [],
                        more: false
                    };
                    if (data && data.data) {
                        $.each(data.data, function() {
                            result.results.push({
                                id: this.id,
                                text: this.name
                            });
                        })
                    }
                    return result;
                },
                cache: false
            },
        });

        $("#id_jabatan").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModal'),
            placeholder: "Pilih Jabatan",
            ajax: {
                url: "{{ route('jabatan/getData') }}",
                dataType: 'json',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                method: 'POST',
                delay: 250,
                destroy: true,
                data: function(params) {
                    var query = {
                        searchkey: params.term || '',
                        start: 0,
                        length: 50
                    }
                    return JSON.stringify(query);
                },
                processResults: function(data) {
                    var result = {
                        results: [],
                        more: false
                    };
                    if (data && data.data) {
                        $.each(data.data, function() {
                            result.results.push({
                                id: this.id,
                                text: this.name
                            });
                        })
                    }
                    return result;
                },
                cache: false
            },
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            var isValid = $("#staffForm").valid();
            if (isValid) {
                $('#saveBtn').text('Save...');
                $('#saveBtn').attr('disabled', true);
                if (!isUpdate) {
                    var url = "{{ route('staff/store') }}";
                } else {
                    var url = "{{ route('staff/update') }}";
                }
                var formData = new FormData($('#staffForm')[0]);
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

        $('#staffTable').on("click", ".btnEdit", function() {
            $('#myModal').modal('show');
            isUpdate = true;
            var id = $(this).attr('data-id');
            var url = "{{ route('staff/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#myModal input[name="nip"]').val(response.data.nip);
                    $('#myModal input[name="id"]').val(response.data.id);
                    $('#myModal input[name="name"]').val(response.data.name);
                    // console.table(response.data);

                    if (response.data.jenis) {
                        var jenis = new Option(response.data.jenis_name, response.data.jenis, true, true);
                        $('.jenis').append(jenis).trigger('change');
                    }

                    if (response.data.golongans) {
                        var golongan = new Option(response.data.golongans.name, response.data.golongans.id, true, true);
                        $('.id_golongan').append(golongan).trigger('change');
                    }

                    if(response.data.jabatans) {
                        var jabatan = new Option(response.data.jabatans.name, response.data.jabatans.id, true, true);
                        $('.id_jabatan').append(jabatan).trigger('change');
                    }

                    if(response.data.instansis) {
                        var instansi = new Option(response.data.instansis.name, response.data.instansis.id, true, true);
                        $('#instansi_id').append(instansi).trigger('change');
                    }
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

        $('#staffTable').on("click", ".btnDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "You will delete this staff. Are you sure you want to continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, I'm sure",
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('staff/delete', ['id' => ':id']) }}";
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

        $('#staffForm').validate({
            rules: {
                nip: {
                    required: true,
                },
                name: {
                    required: true,
                },
                id_jabatan: {
                    required: true,
                },
                id_golongan: {
                    required: true,
                },

                jenis: {
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
            $('#nip').val("");
            $('#name').val("");
            $('#jenis').val("").trigger('change')
            $('#id_golongan').val("").trigger('change');
            $('#id_jabatan').val("").trigger('change');
            isUpdate = false;
        });

        $('.show_in_jenis_pns_only, .other_instance_input').hide();
        $('select#jenis').change(function (e) {
            e.preventDefault();

            if($(this).val() == '0') {
                $('.show_in_jenis_pns_only').show()
            } else {
                $('.show_in_jenis_pns_only').hide()
            }
        });

        $('select#instansi_id').change(function (e) {
            e.preventDefault();

            var instansi_text = $('#instansi_id').select2('data')[0].text;
            console.log(instansi_text);

            if (instansi_text == 'Lainnya') {
                $('.other_instance_input').show()
                $('#instansi_other_id').prop('required', true)
            } else {
                $('.other_instance_input').hide()
                $('#instansi_other_id').prop('required', false)
            }
        });
    });
</script>

@endpush


