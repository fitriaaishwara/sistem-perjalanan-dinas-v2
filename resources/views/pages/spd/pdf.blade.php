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
            padding-top: 6rem;
            padding-bottom: 6rem;
            padding-left: 2rem;
            padding-right: 2rem;
            font-family: "Arial";
        }

        .font-11 {
            font-size: 11px !important;
        }

        .font-12 {
            font-size: 12px !important;
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
    </style>
</head>
<body>
    <div class="text-center font-11">
        <u><h2>SURAT PERJALANAN DINAS (SPD)</h2></u>
    </div>

    <br>

    <div class="font-11">
        <table class="w-100 table table-bordered">
            <tbody>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">1.</td>
                    <td class="p-sm-2">Pejabat Pembuat Komitmen</td>
                    <td colspan="2">
                        @if($spd->spd->pejabat_pembuat_komitmen == 1)
                            <p>Deputi Bidang Kewirausahaan</p>
                        @else
                            <p>Deputi Bidang Pembiayaan dan Pengelolaan Investasi</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">2.</td>
                    <td class="p-sm-2">Nama/NIP Pegawai yang diperintahkan</td>
                    <td colspan="2"> {{ $spd->staff->name }}</td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">3.</td>
                    <td class="text-left mt--0 p-sm-2">
                        a. Pangkat dan Golongan <br>
                        b. Jabatan Instansi<br>
                        c. Tingkat Biaya Perjalanan Dinas
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        a. <br>
                        b. <br>
                        c.
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">4.</td>
                    <td class="p-sm-2">Maksud Perjalanan Dinas</td>
                    <td colspan="2">{{$spd->perjalanan[0]->perihal_perjalanan}}</td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">5.</td>
                    <td class="p-sm-2">Alat Angkutan yang dipergunakan</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">6.</td>
                    <td class="text-left mt--0 p-sm-2">
                        a. Tempat Berangkat <br>
                        b. Tempat Tujuan
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        a. {{$spd->tujuan_perjalanan[0]->tempat_berangkat}} <br>
                        b. {{$spd->tujuan_perjalanan[0]->tempat_tujuan}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">7.</td>
                    <td class="text-left mt--0 p-sm-2">
                        a. Lamanya perjalanan dinas <br>
                        b. Tanggal berangkat<br>
                        c. Tanggal harus kembali/tiba di tempat baru *)
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        a. {{$spd->tujuan_perjalanan[0]->lama_perjalanan}}<br>
                        b. {{ tgl_indo($spd->tujuan_perjalanan[0]->tanggal_berangkat)}}<br>
                        c. {{ tgl_indo($spd->tujuan_perjalanan[0]->tanggal_tiba)}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">8.</td>
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
                    <td class="text-center p-sm-2" style="width: 10%"></td>
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
                    <td class="text-center p-sm-2" style="width: 10%">9.</td>
                    <td class="text-left mt--0 p-sm-2">
                        Pembebanan Anggaran <br>
                        a. Instansi <br>
                        b. Kode Program <br>
                        c. Kode Kegiatan <br>
                        d. Kode Akun
                    </td>
                    <td class="text-left mt--0 p-sm-2" colspan="2">
                        a. Kementrian Koperasi Dan UKM<br>
                        b. <br>
                        c. <br>
                        d. {{$spd->perjalanan[0]->mak->kode_mak}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 10%">10.</td>
                    <td class="p-sm-2">Keterangan lain - lain</td>
                    <td colspan="2"></td>
                </tr>
            </tbody>

        </table>
      </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td class="text-center p-sm-2" style="width: 10%"></td>
                <td></td>
                <u><td>
                    <div>DIKELUARKAN DI : </div>
                    <div>PADA TANGGAL :</div>
                </td></u>
            </tr>
        </table>
    </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td class="text-center p-sm-2" style="width: 10%"></td>
                <td></td>
                <td>
                    <div>Pejabat Pembuat Komitmen</div>
                    <div>Deputi Bidang Kewirausahaan</div>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div>DESTRY ANNA SARI, S.H</div>
                    <div>NIP 19751222 199903 2 001</div>
                </td>
            </tr>
        </table>
    </div>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</body>
</html>
