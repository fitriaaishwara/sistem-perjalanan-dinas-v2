@extends('pages.layouts.master')
@section('content')
@section('title', 'Data Pengajuan')
            <div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Form Pengajuan</h4>
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
								<a href="#">Pengajuan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Form Pengajuan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <form action="{{ route('pengajuan/stores') }}" method="POST" id="pengajuanForm" name="pengajuanForm">
                            @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Informasi Pegawai</div>
                                    </div>
                                    <div id="myModal" class="card-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="staff_type" class="form-label">Tipe Staff<span
                                                        style="color:red;">*</span></label>
                                                <select id="staff_type" type="text" class="form-control col-md-12 col-xs-12 staff_type select2"
                                                    name="staff_type">
                                                    <option value="internal" selected>Internal</option>
                                                    <option value="eksternal">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nip">NIP / NIPPPK / NIK</label>
                                                <input type="text" class="form-control" id="nip" name="nip" minlength="16" maxlength="16" placeholder="NIP / NIPPPK / NIK">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <select id="staff_name" name="staff_name" type="text" class="form-control col-md-12 col-xs-12 staff_name">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_jabatan" class="form-label">Jabatan<span
                                                        style="color:red;">*</span></label>
                                                <select id="id_jabatan" type="text" class="form-control col-md-12 col-xs-12 id_jabatan"
                                                    name="id_jabatan">
                                                </select>
                                            </div>
                                                <div class="form-group">
                                                <label for="golongan_id" class="form-label">Golongan<span
                                                        style="color:re;">*</span>
                                                </label>
                                                <select id="golongan_id" type="text" class="form-control col-12 golongan_id" name="golongan_id">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="instansi">Instansi / Perusahaan</label>
                                                <input type="text" class="form-control" id="instansi" name="instansi" value="" placeholder="Nama Instansi/Perusahaan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Informasi Perjalanan</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="kode_mak">Kode Akun / Mata Anggaran Kegiatan</label>
                                                    <input type="text" class="form-control" id="kode_mak" name="kode_mak" placeholder="Input Kode Akun / Mata Anggaran Kegiatan" validate>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Perihal Perjalanan</label>
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Input Perihal Perjalanan" validate>
                                                </div>
                                                    <div class="form-group">
                                                    <label for="tujuan">Tujuan (Provinsi/Kab/Kota)
                                                    </label><input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Input Provinsi/Kab/Kota) yang dituju" validate>

                                                </div>
                                                <div id="showTanggal_Berangkat" class="form-group">
                                                    <label for="tanggal_berangkat">Tanggal Berangkat</label>
                                                    <input type="text" name="tanggal_berangkat" id="tanggal_berangkat" class="form-control date" placeholder="Pilih Tanggal Berangkat" validate>
                                                </div>
                                                <div id="showTanggal_Kembali" class="form-group">
                                                    <label for="tanggal_kembali">Tanggal Kembali</label>
                                                    <input type="text" name="tanggal_kembali" id="tanggal_kembali" class="form-control date"  placeholder="Pilih Tanggal Kembali" validate>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lama_perjalanan">Lama Perjalanan</label>
                                                    <input type="text" class="form-control" id="lama_perjalanan" name="lama_perjalanan" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="transportasi">Transportasi</label>
                                                    <input type="text" class="form-control" id="transportasi" name="transportasi" value="" placeholder="transportasi yang digunakan">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="btn btn-primary btn-sm" id="saveBtn" name="saveBtn" form="pengajuanForm">Save</button>
						</div>
					</div>
				</div>
			</div>
@endsection

@push('js')

<script type="text/javascript">
	// selingkuhnya programmer? yaa di vs code
    // chuaksss XD

	// apa bedanya kamu sama benda benda lama?
    // kalo benda lama itu antik tapi kamu cantik

	// mandi apa yang engga basah?
	// mandirikan rumah tangga sama kamu

	// apa bedanya kamu sama lukisan?
	// kalo lukisan makin lama makin antik
	// tapi kalo kamu makin cantik

	// perangkat apa yang romantis?
	// gagal :(

	// panda apa yang bikin seneng?
	// pandangin kamu

	// berangkat pagi pagi
	// mencari rezeki
	// demi si fitri

    let staff;
    let staff_type;

    $(function () {
        $('#tanggal_berangkat').flatpickr({
            dateFormat: "Y-m-d",
            //disable past date
            minDate: "today",
        });

        $('#tanggal_kembali').flatpickr({
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        staff_type = $('#staff_type').val()
        console.log(staff_type);

        if (staff_type != 'internal') {
            // destroy select2 to manual input
            $('#staff_name').select2('destroy')
            $('#id_jabatan').hide();
            $('#golongan_id').hide();

            $('#id_jabatan').prop('disabled', false);
            $('#golongan_id').prop('disabled', false);
        } else {
            $('#nip').prop('disabled', true);
            $('#instansi').prop('disabled', true);

            // $('#jabatan_id').select2('enable', false);
            // $('#golongan_id').select2('enable', false);
        }
    });

    $('select#staff_type').change(function (e) {
        e.preventDefault();
        staff_type = $(this).val()
    });

    $('#staff_name').change(function (e) {
        e.preventDefault();
        get_staff_by_id($(this).val()).then((data) => {
            $('#nip').val(data.nip);
            $('#id_jabatan').val(data.id_jabatan).trigger('change')
            $('#golongan_id').val(data.id_golongan).trigger('change')
            $('#id_instansi').val(data.id_instansi).trigger('change')

            console.log(data);
        })
    });

    //make tangga_berangkat and tanggal_kembali to be total days without save data hasilnya berupa misal 2 hari
    $('#tanggal_berangkat , #tanggal_kembali').change(function(){
            var tanggal_berangkat = $('#tanggal_berangkat').val();
            var tanggal_kembali = $('#tanggal_kembali').val();
			if(tanggal_berangkat != '' && tanggal_kembali != '') {
				var date1 = new Date(tanggal_berangkat);
				var date2 = new Date(tanggal_kembali);
				var Difference_In_Time = date2.getTime() - date1.getTime();
				var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24) + " Hari";
				$('#lama_perjalanan').val(Difference_In_Days);
			} else {
				$('#lama_perjalanan').val('0 hari');
			}
        });

    $("#staff_name").select2({
            theme: 'bootstrap',
            width: '100%',
            placeholder: "Nama Pegawai",
            minimumInputLength: 3,
            ajax: {
                url: "{{ route('pengajuan/staff') }}",
                dataType: 'json',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                processResults: function(data) {
                    if (staff_type == 'internal' && data && data.staff) {
                        data = data.staff?.map(item => {
                            console.log(item);
                            return ({
                                id: item.id,
                                text: item.text + " (" + (item.nip) + ") "
                            })
                        })
                        return {
                            results: data
                        };
                    }
                },
                cache: true
            },
        });

        $("#golongan_id").select2({
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
</script>

<script>
    function get_staff_by_id(id) {
      return fetch('/pengajuan/staff/'+ id +'/by_id')
        .then(response => response.json())
        .then(data => {
          return data.staff
        })
    };
</script>
@endpush
