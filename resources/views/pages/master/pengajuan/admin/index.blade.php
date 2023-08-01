@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Pengajuan')

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
                                @foreach ($statusPerjalanan as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
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
                    <a href="#">Master Data</a>
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
                            <table id="myTable" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>NIP/NIPPPK/NIK</th>
                                        <th>Nama</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Tanggal Kembali</th>
                                        <th>MAK</th>
                                        <th>Perihal</th>
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
                    "data": "pegawais",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.nip) {
                            return "<div class='text-wrap'>" + data.nip + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }
                },
                {
                    "data": "pegawais",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.name) {
                            return "<div class='text-wrap'>" + data.name + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }
                },
                {
                    "data": "tujuan",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "tanggal_berangkat",
                    "width": '15%',
                    "defaultContent": "-",
                    //render date format
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap'>" + moment(data).format('DD MMM YYYY') + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }

                },
                {
                    "data": "tanggal_kembali",
                    "width": '15%',
                    "defaultContent": "-",
                     //render date format
                    render: function(data, type, row) {
                        if (data) {
                            return "<div class='text-wrap'>" + moment(data).format('DD MMM YYYY') + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }
                },
                {
                    "data": "maks",
                    "width": '10%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.kode_mak) {
                            return "<div class='text-wrap'>" + data.kode_mak + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }
                },
                {
                    "data": "keterangan",
                    "width": '20%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                },
                {
                    "data": "status_perjalanans",
                    "width": '15%',
                    "defaultContent": "-",
                    render: function(data, type, row) {
                        if (data && data.name) {
                            return "<div class='text-wrap'>" + data.name + "</div>";
                        } else {
                            return "<div class='text-wrap'>-</div>";
                        }
                    }
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
                        btnDelete += '<button name="btnDelete" data-id="' + data +
                            '" type="button" class="btn btn-danger btn-sm btnDelete m-1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';

                        return btnEdit + btnStatus + btnDelete;
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







