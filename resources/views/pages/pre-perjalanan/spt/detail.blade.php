@extends('pages.layouts.master')
@section('content')
@section('title', 'Detail SPT')
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
                        Surat Perintah Tugas
                    </span>
                </h5>
                <button type="button" class="close" aria-label="Close" id="modalCloseBtn">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('spt.upload') }}" id="SptForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id_tujuan" name="id_tujuan" value="{{ $tujuan->id }}">
                    <div class="row mb-4">
                        <label for="file_spt" class="col-sm-3 col-form-label">File<span style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input class="form-control" id="file_spt" name="file_spt" type="file" required>
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
            <h4 class="page-title">Detail SPT</h4>
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
                    <a href="#">Surat Pre-Perjalanan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detail SPT</a>
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
                                        <td>Surat Perintah Tugas</td>
                                        <td>
                                            <a href="{{ route('spt/pdf', $tujuan->id) }}" class="btn btn-primary btn-sm">PDF</a>
                                            <a href="{{ route('exportSpt', $tujuan->id) }}" class="btn btn-success btn-sm">Excel</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Surat Perintah Tugas (Sudah TTD)</td>
                                        @if($spt->file_spt != null)
                                            <td>
                                                <a href="{{ route('spt/download', $spt->id) }}" class="btn btn-primary btn-sm">Download</a>
                                            </td>
                                        @else
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm"
                                            data-toggle="modal" data-target="#myModal" id="addNew" name="addNew"><i class="fa fa-plus"></i> Upload File</a>
                                        </td>
                                        @endif

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
        var isValid = $("#SptForm").valid();
        if (isValid) {
            $('#saveBtn').text('Save...');
            $('#saveBtn').attr('disabled', true);
            var url = isUpdate ? "{{ route('spt.upload.edit') }}" : "{{ route('spt.upload') }}";
            var formData = new FormData($('#SptForm')[0]);
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
                    location.reload();
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
        var url = "{{ route('spt.show', ['id' => ':id']) }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $('#id_tujuan').val(response.data.id_tujuan);
                $('#file_spt').val(response.data.file_spt);
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
        $('#SptForm')[0].reset(); // Reset form fields
    });
</script>
@endpush
