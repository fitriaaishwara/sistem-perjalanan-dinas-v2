@extends('pages.layouts.master')
@section('content')
@section('title', 'Upload Dokumen')

        <!-- Modal -->
        <div id="myModalBerangkat" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalBerangkatLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header border-0" id="myModalBerangkatLabel">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                            Upload</span>
                            <span class="fw-light">
                                Dokumen
                            </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('transportasiBerangkat/store') }}" id="transportasiBerangkatForm" name="transportasiBerangkatForm">
                            @csrf
                            <input id="id" type="hidden" class="form-control" name="id">
                            <div class="row mb-4">
                                <label for="id_transportasi" class="col-sm-3 col-form-label">Transportasi<span
                                        style="color:red;">*</span></label>
                                <div class="col-sm-9 validate">
                                    <select class="form-control id_transportasi" id="id_transportasi" name="id_transportasi">
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="deskripsi_file" class="col-sm-3 col-form-label">Nama File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="deskripsi_file" name="deskripsi_file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="file" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="file" name="file" type="file">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                                <div class="col-sm-9 validate">
                                    <input class="form-control" id="nominal" name="nominal">
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
                    <h4 class="page-title">Upload Dokumen</h4>
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
                            <a href="#">Upload File</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Transportsi Berangkat</h4>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                                        data-toggle="modal" data-target="#myModalBerangkat" id="addNew" name="addNew"><i class="fa fa-plus"></i></a>
                                        {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>Create
                                        </button> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="berangkatTable" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Transportasi</th>
                                                <th>Nama File</th>
                                                <th>File</th>
                                                <th>Nominal</th>
                                                <th>Ukuran File</th>
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

        var berangkatTable = $('#berangkatTable').DataTable({
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
                "url": "{{ route('uploadByIdBerangkat/getData', ['id_staff_perjalanan' => $dataStaff]) }}",
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
                    "data": "name",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                    },
                },
                {
                    "data": "description",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        let description = (data) ? data : '-';
                        return "<div class='text-wrap' style='font-size: 12px;'>" + description + "</div>";
                    },
                },
                {
                    "data": "description",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        let description = (data) ? data : '-';
                        return "<div class='text-wrap' style='font-size: 12px;'>" + description + "</div>";
                    },
                },
                {
                    "data": "description",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        let description = (data) ? data : '-';
                        return "<div class='text-wrap' style='font-size: 12px;'>" + description + "</div>";
                    },
                },
                {
                    "data": "description",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        let description = (data) ? data : '-';
                        return "<div class='text-wrap' style='font-size: 12px;'>" + description + "</div>";
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
            berangkatTable.ajax.reload(null, false); //reload datatable ajax
        }

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            var isValid = $("#transportasiBerangkatForm").valid();
            if (isValid) {
                $('#saveBtn').text('Save...');
                $('#saveBtn').attr('disabled', true);
                if (!isUpdate) {
                    var url = "{{ route('transportasiBerangkat/store') }}";
                } else {
                    var url = "{{ route('transportasiBerangkat/update') }}";
                }
                var formData = new FormData($('#transportasiBerangkatForm')[0]);
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
                        $('#myModalBerangkat').modal('hide');
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

        $('#berangkatTable').on("click", ".btnEdit", function() {
            $('#myModalBerangkat').modal('show');
            isUpdate = true;
            var id = $(this).attr('data-id');
            var url = "{{ route('transportasiBerangkat/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#name').val(response.data.name);
                    $('#description').val(response.data.description);
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

        $('#berangkatTable').on("click", ".btnDelete", function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "Kamu akan menghapus transportasi berangkat. Apakah kamu ingin melanjutkan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, I'm sure",
                cancelButtonText: 'No'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('transportasiBerangkat/delete', ['id' => ':id']) }}";
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

        $("#id_transportasi").select2({
            theme: 'bootstrap',
            width: '100%',
            dropdownParent: $('#myModalBerangkat'),
            placeholder: "Pilih Transportasi",
            ajax: {
                url: "{{ route('transportasi/getData') }}",
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

        $('#transportasiBerangkatForm').validate({
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
            $('#name').val("");
            isUpdate = false;
        });
    });
</script>
@endpush


