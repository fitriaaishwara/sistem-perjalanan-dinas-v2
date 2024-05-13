@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Pengajuan')
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
            <h4 class="page-title">Detail Status</h4>
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
                    <a href="#">Status</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pengajuanTable" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu</th>
                                        <th>Status Perjalanan</th>
                                        <th>Deskripsi</th>
                                        <th>Direvisi Oleh</th>
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

                var pengajuanTable = $('#pengajuanTable').DataTable({
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
                        "url": "{{ route('detail-status/getData' , ['id_perjalanan' => $perjalanan->id]) }}",
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
                            "data": "no",
                            "width": '5%',
                            "defaultContent": "-",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        {
                            "data": "created_at",
                            "width": '20%',
                            "defaultContent": "-",
                            render: function(data, type, row, meta) {
                                return moment(data).format('DD MMMM YYYY HH:mm:ss');
                            },
                        },
                        {
                            "data": "status_perjalanan",
                            "width": '20%',
                            "defaultContent": "-",
                            render: function(data, type, row, meta) {
                                return "<div class='text-wrap' style='font-size: 12px;'>" + data.status_perjalanan + "</div>";
                            },

                        },
                        {
                            "data": "description",
                            "width": '55%',
                            "defaultContent": "-",
                            "render": function(data, type, row, meta) {
                                if (data === null || data === '') {
                                    return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                                } else {
                                    return "<div class='text-wrap' style='font-size: 12px;'>" + data + "</div>";
                                }
                            }
                        },

                        {
                        "data": "user",
                        "width": '20%',
                        "defaultContent": "-",
                        "render": function(data, type, row, meta) {
                            if (data && data.name) {
                                return "<div class='text-wrap' style='font-size: 12px;'>" + data.name + "</div>";
                            } else {
                                return "<div class='text-wrap' style='font-size: 12px;'>-</div>";
                            }
                        }
                    }
                ]
            });

            function reloadTable() {
                pengajuanTable.ajax.reload(null, false); //reload datatable ajax
            }
        });
    </script>
@endpush







