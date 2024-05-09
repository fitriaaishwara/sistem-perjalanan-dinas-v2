<!DOCTYPE html>
<html>
<head>
    <title>Surat Perjalanan Dinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">


    <style>
        .body {
            text-indent: 25px;
            text-align: justify
        }

        .text {
            text-indent: 10px;
            text-align: justify
        }

        body {
            padding-top: 0rem;
            padding-bottom: none;
            padding-left: 0rem;
            padding-right: 0rem;
            font-family: "Arial";
        }

        .font-11 {
            font-size: 8px !important;
        }

        .font-12 {
            font-size: 9px !important;
        }
        .tabel_ttd {
            table-layout:fixed; /* this keeps your columns with at the defined width */
            display: table;
            width: 100%;
        }

        .tabel_ttd td {
            width: calc(100% / 3)
        }

        .tabel_spd {
            table-layout:fixed; /* this keeps your columns with at the defined width */
            display: table;
            width: 100%;
        }

        .tabel_spd td {
            width: calc(100% / 3)
        }

        .tbl , .tbl th, .tbl td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            padding: 0; /* Menghilangkan padding */
            margin: 0; /* Menghilangkan margin */
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="text-center font-11">
        <u><h2>SURAT PERJALANAN DINAS (SPD)</h2></u>
    </div>

    <br>

    <div class="font-11">
        <table class="w-100 table table-bordered tbl">
            <tbody>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">1.</td>
                    <td class="p-sm-2">Pejabat Pembuat Komitmen</td>
                    <td colspan="2" class="p-sm-2">
                        @if($spd->spd->pejabat_pembuat_komitmen == 1)
                            <p>Deputi Bidang Kewirausahaan</p>
                        @else
                            <p>Deputi Bidang Pembiayaan dan Pengelolaan Investasi</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">2.</td>
                    <td class="p-sm-2">Nama/NIP Pegawai yang diperintahkan</td>
                    <td colspan="2" class="p-sm-2"> {{ $spd->staff->name }}</td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">3.</td>
                    <td class="text-left mt--0 p-sm-2">
                        a. Pangkat dan Golongan <br>
                        b. Jabatan/Instansi<br>
                        c. Tingkat Biaya Perjalanan Dinas
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        a. {{$spd->staff->golongans->name}} <br>
                        b. {{$spd->staff->jabatans->name}} <br>
                        c. {{$spd->spd->tingkat_biaya_perjalanan_dinas}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">4.</td>
                    <td class="p-sm-2">Maksud Perjalanan Dinas</td>
                    <td colspan="2" class="p-sm-2">{{$spd->perjalanan[0]->kegiatan[0]->kegiatan}} </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">5.</td>
                    <td class="p-sm-2">Alat Angkutan yang dipergunakan</td>
                    <td colspan="2" class="p-sm-2">
                            @if ($spd->spd->alat_angkutan == 1)
                                Pesawat
                            @elseif ($spd->spd->alat_angkutan == 2)
                                Kereta Api
                            @elseif($spd->spd->alat_angkutan == 3)
                                Kapal Laut
                            @elseif($spd->spd->alat_angkutan == 4)
                                Kendaraan Dinas
                            @elseif($spd->spd->alat_angkutan == 5)
                                Kendaraam Pribadi
                            @elseif ($spd->spd->alat_angkutan == 6)
                                Angkutan Umum
                            @else
                                Lainnya
                            @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">6.</td>
                    <td class="text-left mt--0 p-sm-2">
                        a. Tempat Berangkat <br>
                        b. Tempat Tujuan
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        a. {{$spd->tujuan_perjalanan[0]->tempatBerangkat->name}} <br>
                        b. {{$spd->tujuan_perjalanan[0]->tempatTujuan->name}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">7.</td>
                    <td class="text-left mt--0 p-sm-2">
                        a. Lamanya perjalanan dinas <br>
                        b. Tanggal berangkat<br>
                        c. Tanggal harus kembali/tiba di tempat baru *)
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        a. {{$spd->tujuan_perjalanan[0]->lama_perjalanan}} Hari <br>
                        b. {{ tgl_indo($spd->tujuan_perjalanan[0]->tanggal_berangkat)}}<br>
                        c. {{ tgl_indo($spd->tujuan_perjalanan[0]->tanggal_tiba)}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">8.</td>
                    <td class="text-left mt--0 p-sm-2">
                        Pengikut : Nama
                    </td>
                    <td class="text-left mt--0 p-sm-2">
                        Tanggal Lahir
                    </td>
                    <td class="text-left mt--0 p-sm-2">
                        Keterangan
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%"></td>
                    <td class="text-left mt--0 p-sm-2">
                        1. <br>
                        2. <br>
                        3.
                    </td>
                    <td class="text-left mt--0 p-sm-2">
                    </td>
                    <td class="text-left mt--0 p-sm-2">
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">9.</td>
                    <td class="text-left mt--0 p-sm-2">
                        Pembebanan Anggaran <br>
                        a. Instansi <br>
                        b. Kode Program <br>
                        c. Kode Kegiatan <br>
                        d. Kode Akun
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        <br>
                        a. Kementrian Koperasi Dan UKM<br>
                        b. <br>
                        c. <br>
                        d. {{$spd->perjalanan[0]->mak->kode_mak}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 20%">10.</td>
                    <td class="p-sm-2">Keterangan lain - lain</td>
                    <td colspan="2"></td>
                </tr>
            </tbody>

        </table>
      </div>

      <br>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td class="text-center p-sm-2" style="width: 20%"></td>
                <td></td>
                <td></td>
                <td>
                    <div>DIKELUARKAN DI : Jakarta <br>
                        PADA TANGGAL : {{ tgl_indo($spd->spd->pada_tanggal) }}<br>
                        <hr size="1" width="100%" color="black" style="border-top: 1px solid black; padding: 0; margin: 0;">
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td class="text-center p-sm-2" style="width: 20%"></td>
                <td></td>
                <td></td>
                <td>
                    <div class="text-center p-sm-2">Pejabat Pembuat Komitmen <br> {{ $spd->staff->jabatans->name }}</div>

                    {!!( Str::repeat('<br>', 3) )!!}

                    <div class="text-center p-sm-2" style="text-transform: uppercase;">{{ $spd->staff->name }}<br>NIP {{ $spd->staff->nip }}</div>
                </td>
            </tr>
        </table>
    </div>

    <style>
        table, th, td {
            border-collapse: collapse;
            width: 100%;
        }

    </style>
</body>
</html>
