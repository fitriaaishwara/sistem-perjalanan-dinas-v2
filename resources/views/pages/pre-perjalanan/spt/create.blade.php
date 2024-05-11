@extends('pages.layouts.master')
@section('content')
@section('title', 'Surat Perintah Tugas')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Form Surat Perintah Tugas</h4>
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
                    <a href="#">Surat Perintah Tugas</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Form Surat Perintah Tugas</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('spt/store') }}" method="POST" id="pengajuanForm">
                    @csrf
                    <div class="card">
                        {{-- <div class="card-header">
                                        <div class="card-title">Surat Perintah Tugas</div>
                                    </div> --}}
                        <div id="myModal" class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="nomor_spt">Staff Yang Ditugaskan</label>
                                    <br>
                                    <div class="table-responsive">
                                        <table id="myTable" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th>Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataStaff as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->staff->name }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div id="showDikeluarkan_tanggal" class="form-group">
                                    <label for="dikeluarkan_tanggal">Tujuan</label>
                                    <input type="text" class="form-control date"
                                        value="{{ $tujuan->tempatTujuan->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_spt">Tanggal Berangkat - Tanggal Kembali</label>
                                    <input type="text" class="form-control date"
                                        value="{{ tgl_indo($tujuan->tanggal_berangkat) }} - {{ tgl_indo($tujuan->tanggal_pulang) }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Surat Perintah Tugas</div>
                        </div>
                        <div id="myModal" class="card-body">
                            <div class="col-lg-12">
                                <input type="hidden" name="id_tujuan" id="id_tujuan" value="{{ $tujuan->id }}">
                                <input type="hidden" name="nip_staff" id="nip_staff" value="{{ $tujuan->staff[0]->nip_staff }}">
                                <div class="form-group">
                                    <label for="nomor_spt">Nomor SPT</label>
                                    <select name="nomor_spt" id="nomor_spt" class="form-control select2" validate>
                                        <option value="">Pilih Nomor SPT</option>
                                        @php
                                            $bulan = date('n');
                                            $tahun = date('Y');
                                            $bulan_romawi = intToRoman($bulan);
                                        @endphp
                                        {{-- <option value="1">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;/SesDep.4/SPT/ {{ $bulan_romawi }}/{{ $tahun }}</option>
                                        <option value="2">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;/Dep.4/SPT/ {{ $bulan_romawi }}/{{ $tahun }}</option> --}}
                                        <option value="/SesDep.4/SPT/ {{ $bulan_romawi }}/{{ $tahun }}">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;/SesDep.4/SPT/ {{ $bulan_romawi }}/{{ $tahun }}</option>
                                        <option value="/SesDep.4/SPT/ {{ $bulan_romawi }}/{{ $tahun }}">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;/Dep.4/SPT/ {{ $bulan_romawi }}/{{ $tahun }}</option>
                                    </select>
                                </div>
                                <div id="showDikeluarkan_tanggal" class="form-group">
                                    <label for="dikeluarkan_tanggal">Dikeluarkan Tanggal</label>
                                    <input type="text" name="dikeluarkan_tanggal" id="dikeluarkan_tanggal" class="form-control date" placeholder="Pilih Tanggal SPT terbit" validate>
                                </div>
                                <div class="form-group">
                                    <label for="nip_staff_penandatangan">Penandatangan SPT</label>
                                    <select name="nip_staff_penandatangan" id="nip_staff_penandatangan" class="form-control select2" validate>
                                        <option value="">Pilih Penandatangan</option>
                                        @foreach ($staff as $item)
                                            <option value="{{ $item->nip }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <button type="submit" class="btn btn-primary btn-sm" id="saveBtn" name="saveBtn"
                    form="pengajuanForm">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(function() {
        $('#dikeluarkan_tanggal').flatpickr({
            dateFormat: "Y-m-d",
        });

        //select2
        $('.select2').select2({
            placeholder: 'Pilih Data',
            theme: 'bootstrap',
            allowClear: true
        });

    });
</script>
@endpush
