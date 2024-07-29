@extends('pages.layouts.master')
@section('content')
@section('title', 'Detail Kwitansi')
<head>
    ...
    @include('sweetalert::alert')
</head>
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0" id="myModalLabel">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Upload</span>
                    <span class="fw-light">
                        Kwitansi
                    </span>
                </h5>
                <button type="button" class="close" aria-label="Close" id="modalCloseBtn">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('kwitansi.upload') }}" id="KwitansiForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id_staff_perjalanan" name="id_staff_perjalanan" value="{{ $kwitansi->id }}">
                    <div class="row mb-4">
                        <label for="file_kwitansi" class="col-sm-3 col-form-label">File<span style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input class="form-control" id="file_kwitansi" name="file_kwitansi" type="file" required>
                        </div>
                    </div>
                    <button type="submit" id="saveBtn" class="btn btn-dark waves-effect waves-light btn-sm">Save changes</button>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-dark waves-effect waves-light btn-sm" id="saveBtn" name="saveBtn">Save changes</button>
                <button type="button" class="btn btn-secondary waves-effect btn-sm" id="modalCloseBtnFooter">Close</button>
            </div> --}}
        </div>
    </div>
</div>
<!-- Modal -->

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Detail Kwitansi</h4>
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
                    <a href="#">Detail Kwitansi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lembar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Lembar 1</td>
                                        <td>
                                            <a href="{{ url('kwitansi/pdf', $kwitansi->id) }}" class="btn btn-primary btn-sm">PDF</a>
                                            <a href="{{ url('exportKwitansi1', $kwitansi->id) }}" class="btn btn-success btn-sm">Excel</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Lembar 2</td>
                                        <td>
                                            <a href="{{ url('kwitansi/pdf2', $kwitansi->id) }}" class="btn btn-primary btn-sm">PDF</a>
                                            <a href="{{ url('exportKwitansi2', $kwitansi->id) }}" class="btn btn-success btn-sm">Excel</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Kwitansi (Sudah TTD)</td>
                                        <td>
                                            @if($kwitansi->kwitansi->file_kwitansi != null)
                                            <a href="{{ route('kwitansi/download', $kwitansi->kwitansi->id) }}" class="btn btn-primary btn-sm">Download</a>
                                            @else
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm"
                                            data-toggle="modal" data-target="#myModal" id="addNew" name="addNew"><i class="fa fa-plus"></i> Upload File</a>


                                            @endif
                                        </td>
                                    </tr>
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
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('/upload-endpoint', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.text();
        })
        .then(message => {
            Swal.fire({
                title: 'Success',
                text: message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        })
        .catch(error => {
            Swal.fire({
                title: 'Error',
                text: error.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
    </script>
    <script type="text/javascript">
        var isUpdate = false; // Define isUpdate variable

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            var isValid = $("#KwitansiForm").valid();
            if (isValid) {
                $('#saveBtn').text('Save...');
                $('#saveBtn').attr('disabled', true);
                var url = isUpdate ? "{{ route('kwitansi.upload.edit') }}" : "{{ route('kwitansi.upload') }}";
                var formData = new FormData($('#KwitansiForm')[0]);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire(
                            data.status ? 'Success' : 'Error',
                            data.message,
                            data.status ? 'success' : 'error'
                        )
                        $('#saveBtn').text('Save');
                        $('#saveBtn').attr('disabled', false);
                        if (data.status) {
                            location.reload();
                            $('#myModal').modal('hide');
                            //reload page

                        }
                    },
                    error: function(data) {
                        Swal.fire(
                            'Error',
                            'A system error has occurred. Please try again later.',
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
            var url = "{{ route('kwitansi.show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#id_tujuan').val(response.data.id_tujuan);
                    $('#file_kwitansi').val(response.data.file_kwitansi);
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

        $('#myModal').on('hidden.bs.modal', function () {
            isUpdate = false; // Reset isUpdate when modal is closed
            $('#KwitansiForm')[0].reset(); // Reset form fields
        });
    </script>
@endpush
