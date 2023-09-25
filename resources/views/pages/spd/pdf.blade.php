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
        <u><h1>SURAT PERJALANAN DINAS</h1></u>
    </div>

    <br>

    <div class="font-11">
        <table class="w-100 table table-bordered">
            <tbody>
                <tr>
                    <td class="text-center" style="width: 10%">1.</td>
                    <td class="text-center">Pejabat Pembuat Komitmen</td>
                    <td class="text-center">Deputi Bidang Kewirausahaan</td>
                </tr>
                <tr>
                    <td class="text-center" style="width: 10%">2.</td>
                    <td class="text-center">Nama/NIP Pegawai yang melaksanakan Perjalanan Dinas</td>
                    <td class="text-center"></td>
                </tr>
                <tr>
                    <td class="text-center" style="width: 10%">3.</td>
                    <td class="text-left mt--0 p-sm-2">
                        a. Pangkat dan Golongan <br>
                        b. Jabatan Instansi<br>
                        c. Tingkat Biaya Perjalanan Dinas
                    </td>
                    <td class="text-left mt--0 p-sm-2">
                        a. <br>
                        b. <br>
                        c.</td>

                </tr>
            </tbody>

        </table>
      </div>

    <br>

    <div class="body font-12">

    </div>

    {!!( Str::repeat('<br>', 2) )!!}

    <div class="font-11 w-100">
        <table class="w-100 tabel_spd">
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>DIKELUARKAN DI : </div>
                    <div>PADA TANGGAL :</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="font-11 w-100">
        <table class="w-100 tabel_ttd">
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>Sekretaris Deputi</div>
                    <div>Deputi Bidang Kewirausahaan</div>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div>Bastian</div>
                    <div>NIP 196904 17 199403 1 001</div>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <table class="w-100 tabel_ttd">
            <tr>
                <td>
                    <div><div>
                    <div></div>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div></div>
                    <div></div>
                </td>
            </tr>
        </table>
    </div>
    <!-- Add other fields as needed -->

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td style="width: 250px">
                    Tembusan
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
            </tr>
            <tr>
                <td style="width: 100px">
                    1. Kuasa Pengguna Anggaran<br>
                    2. Pejabat Penguji dan Pendatanganan SPM<br>
                    3. Sdr. Bendahara ybs.<br>
                    4. Arsip
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
