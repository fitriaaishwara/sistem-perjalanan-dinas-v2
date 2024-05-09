@extends('pages.layouts.master')
@section('content')
@section('title', 'Gallery')

<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header border-0" id="myModalLabel">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Gallery</span>
                    <span class="fw-light">
                        Foto
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('gallery/store') }}" id="galleryForm" name="galleryForm" enctype="multipart/form-data">
                    @csrf
                    <input id="id" type="hidden" class="form-control" name="id_tujuan_perjalanan" value="{{ $kegiatan->perjalanan->tujuan[0]->id }}">
                    <input id="id_data_kegiatan" type="hidden" class="form-control" name="id_data_kegiatan" value="{{ $kegiatan->perjalanan->DataKegiatan[0]->id }}">
                    <div class="row mb-4">
                        <label for="name_file" class="col-sm-3 col-form-label">Nama File<span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input id="name_file" type="text" class="form-control" name="name_file">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="path_file" class="col-sm-3 col-form-label">File<span
                            style="color:red;">*</span></label>
                        <div class="col-sm-9 validate">
                            <input class="form-control" id="path_file" name="path_file" type="file">
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
            <h4 class="page-title">Gallery</h4>
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
                    <a href="#">Dokumentasi</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Gallery</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>{{ $kegiatan->kegiatan}}</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Yang Ditugaskan</b></p>
                                @foreach($kegiatan->perjalanan->data_staff_perjalanan as $index => $dataStaff)
                                    <p>{{ $index + 1 }}. {{ $dataStaff->staff->name }}</p>
                                @endforeach
                                <p><b>Tujuan</b></p>
                                <p>{{ $kegiatan->perjalanan->tujuan[0]->tempatBerangkat->name }} - {{ $kegiatan->perjalanan->tujuan[0]->tempatTujuan->name }}</p>
                                <p><b>Waktu</b></p>
                                <p>{{ tgl_indo($kegiatan->perjalanan->tujuan[0]->tanggal_tiba) }} - {{ tgl_indo($kegiatan->perjalanan->tujuan[0]->tanggal_pulang) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <button class="btn btn-primary btn-round" style="float: right;"><i class="fas fa-plus"></i> Tambah Gambar</button> --}}
                        <a href="javascript:void(0)" class="btn btn-primary btn-round ml-auto"
                        data-toggle="modal" data-target="#myModal" id="addNew" name="addNew"><i class="fa fa-plus"></i> Tambah Gambar</a>
                    </div>
                    <div class="card-body">
                        <div class="row image-gallery">

                            @if ($kegiatan->perjalanan->tujuan[0]->uploadGallery->count() == 0)
                                <div class="col-12">
                                    <center>
                                        <h4>Belum ada gambar</h4>
                                    </center>
                                </div>
                            @else
                                @foreach($kegiatan->perjalanan->tujuan[0]->uploadGallery as $item)
                                    <a href="{{ url('storage/gallery/' . $item->path_file) }}" class="col-6 col-md-3 mb-4">
                                    <img src="{{ url('storage/gallery/'. $item->path_file) }}" class="img-fluid">
                                    <center>
                                        <p class="demo m-2">
                                            <button type="button" class="btn btn-icon btn-round btn-primary">
                                                <i class="far fa-eye btn-xs"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon btn-round btn-danger">
                                                <i class="fas fa-trash-alt btn-xs"></i>
                                            </button>
                                        </p>
                                    </center>
                                @endforeach
                            @endif
                            {{-- <a href="../../assets/img/examples/example1.jpeg" class="col-6 col-md-3 mb-4">
                                <img src="../../assets/img/examples/example1-300x300.jpg" class="img-fluid">
                                <center>
                                    <p class="demo m-2">
                                        <button type="button" class="btn btn-icon btn-round btn-primary">
                                            <i class="far fa-eye btn-xs"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-round btn-danger">
                                            <i class="fas fa-trash-alt btn-xs"></i>
                                        </button>
                                    </p>
                                </center>
                            </a> --}}
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
    // This will create a single gallery from all elements that have class "gallery-item"
    $('.image-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        removalDelay: 300,
        gallery:{
            enabled:true,
        },
        mainClass: 'mfp-with-zoom',
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });

    $('#saveBtn').click(function(e) {
        e.preventDefault();
        var isValid = $("#galleryForm").valid();
        if (isValid) {
            $('#saveBtn').text('Save...');
            $('#saveBtn').attr('disabled', true);
            var url = "{{ route('gallery/store') }}";
            var formData = new FormData($('#galleryForm')[0]);
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

                    $('#myModal').modal('hide');
                     // Reload the page after success
                     window.location.reload();
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

    $('#myTable').on("click", ".btnTambah", function() {
            $('#myModal').modal('show');
            // isUpdate = false;
            var id = $(this).attr('data-id');
            var url = "{{ route('gallery/show', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
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
</script>
@endpush





