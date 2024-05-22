@extends('pages.layouts.master')
@section('content')
@section('title', 'Detail Perjalanan')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Detail Perjalanan</h4>
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
                        <a href="#">Perjalanan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail Perjalanan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-space">
                        <div class="card-header">
                            <h4 class="card-title">FAQ Example</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active show" id="v-pills-buy-tab-icons" data-toggle="pill" href="#v-pills-buy-icons" role="tab" aria-controls="v-pills-buy-icons" aria-selected="false">
                                            <i class="flaticon-cart"></i>
                                            Anggaran
                                        </a>
                                        <a class="nav-link" id="v-pills-profile-tab-icons" data-toggle="pill" href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons" aria-selected="false">
                                            <i class="flaticon-user-4"></i>
                                            Tujuan
                                        </a>
                                        <a class="nav-link" id="v-pills-home-tab-icons" data-toggle="pill" href="#v-pills-home-icons" role="tab" aria-controls="v-pills-home-icons" aria-selected="true">
                                            <i class="flaticon-round"></i>
                                            Kegiatan
                                        </a>


                                        {{-- <a class="nav-link" id="v-pills-quality-tab-icons" data-toggle="pill" href="#v-pills-quality-icons" role="tab" aria-controls="v-pills-quality-icons" aria-selected="false">
                                            <i class="flaticon-hands"></i>
                                            Quality
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                                            <div class="accordion accordion-secondary">
                                                @foreach ($perjalanan->kegiatan-> where('status', '1') as $key => $value)
                                                <div class="card">
                                                    <div class="card-header collapsed" id="heading{{ $loop->iteration }}" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}" role="button">
                                                        <div class="span-icon">
                                                            <div class="flaticon-box-1"></div>
                                                        </div>
                                                        <div class="span-title">
                                                            {{ $value->kegiatan }}
                                                        </div>
                                                        <div class="span-mode"></div>
                                                    </div>

                                                    <div id="collapse{{ $loop->iteration }}" class="collapse" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Nama</th>
                                                                            <th>Tujuan</th>
                                                                            <th>Tanggal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    {{-- <tbody>
                                                                        @foreach ($value->DataKegiatan as $kegiatan)
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>{{ $kegiatan->staff->name }}</td>
                                                                            <td>{{ $kegiatan->tujuan->tempatBerangkat->name }} - {{ $kegiatan->tujuan->tempatTujuan->name }}</td>
                                                                            <td>{{ tgl_indo($kegiatan->tujuan->tanggal_berangkat) }} - {{ tgl_indo($kegiatan->tujuan->tanggal_kembali) }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody> --}}
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                                <div class="card" type="hidden">
                                                    <div class="card-header " id="headingTwo"
                                                    data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapseTwo" role="button">
                                                    <div class="span-title">
                                                    </div>

                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="v-pills-profile-icons" role="tabpanel" aria-labelledby="v-pills-profile-tab-icons">
                                        @foreach ($perjalanan->tujuan-> where('id_perjalanan', $perjalanan->id) as $key => $value)
                                            <div class="card">
                                                <div class="card-header collapsed" id="heading{{ $loop->iteration }}" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}" role="button">
                                                    <div class="span-icon">
                                                        <div class="flaticon-box-1"></div>
                                                    </div>
                                                    <div class="span-title">
                                                        {{ $value->tempatBerangkat->name }} - {{ $value->tempatTujuan->name }} ({{ tgl_indo($value->tanggal_berangkat) }} - {{ tgl_indo($value->tanggal_pulang) }})
                                                    </div>
                                                    <div class="span-mode"></div>
                                                </div>
                                                <div id="collapse{{ $loop->iteration }}" class="collapse show" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Nama</th>
                                                                        <th>Tujuan</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($value->DataKegiatan as $kegiatan)
                                                                    <tr>
                                                                        <th scope="row">1</th>
                                                                        <td>{{ $kegiatan->staff->name }}</td>
                                                                        <td>{{ $kegiatan->kegiatan->kegiatan }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                    </div> --}}
                                    <div class="tab-pane fade  active show" id="v-pills-buy-icons" role="tabpanel" aria-labelledby="v-pills-buy-tab-icons">
                                        {{-- <h5 class="mt-3">Anggaran</h5> --}}
                                        {{-- <hr /> --}}
                                        <p>Kode Mak :</p>
                                        <p>Total anggaran yang digunakan :</p>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="v-pills-quality-icons" role="tabpanel" aria-labelledby="v-pills-quality-tab-icons">
                                        <div class="accordion accordion-secondary">
                                            <div class="card">
                                                <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour" role="button">
                                                    <div class="span-icon">
                                                        <div class="flaticon-box-1"></div>
                                                    </div>
                                                    <div class="span-title">
                                                        Lorem Ipsum #1
                                                    </div>
                                                    <div class="span-mode"></div>
                                                </div>

                                                <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion" role="button">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header collapsed" id="headingFive"
                                                data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" role="button">
                                                <div class="span-icon">
                                                    <div class="flaticon-box-1"></div>
                                                </div>
                                                <div class="span-title">
                                                    Lorem Ipsum #2
                                                </div>
                                                <div class="span-mode"></div>
                                            </div>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" role="button">
                                                <div class="span-icon">
                                                    <div class="flaticon-box-1"></div>
                                                </div>
                                                <div class="span-title">
                                                    Lorem Ipsum #3
                                                </div>
                                                <div class="span-mode"></div>
                                            </div>
                                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

