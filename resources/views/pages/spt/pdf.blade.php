<!DOCTYPE html>
<html>
<head>
    <title>Nota Dinas {{ $data->nomor_nota_dinas }}</title>
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
        <h1>SURAT PERINTAH TUGAS</h1>
        <p>Nomor : {{ $data->nomor_nota_dinas }}</p>
    </div>

    <br>

    <div class="font-11">
        <table class="w-100">
            <tr>
                <td style="width: 250px">
                    I.  DIPERINTAHKAN KEPADA
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
            </tr>
            <tr>
                <td class="text" style="width: 100px">
                    1. Nama
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->pegawai->name }}
                </td>
            </tr>
            <tr>
                <td class="text" style="width: 100px">
                    2. Jabatan
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->dari_nota_dinas }}
                </td>
            </tr>
            <tr>
                <td class="text" style="width: 100px">
                    1. Nama
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->dari_nota_dinas }}
                </td>
            </tr>
            <tr>
                <td class="text" style="width: 100px">
                    2. Jabatan
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->dari_nota_dinas }}
                </td>
            </tr>
            <tr>
                <td class="text" style="width: 100px">
                    1. Nama
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->dari_nota_dinas }}
                </td>
            </tr>
            <tr>
                <td class="text" style="width: 100px">
                    2. Jabatan
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->dari_nota_dinas }}
                </td>
            </tr>
            <tr>
                <td style="width: 250px">
                    II.  MAKSUD PERJALANAN
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
            </tr>
            <tr>
                <td style="width: 250px">
                    III.  TUJUAN
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
            </tr>
            <tr>
                <td style="width: 250px">
                    IV.  JANGKA WAKTU
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
            </tr>
            <tr>
                <td style="width: 250px">
                    V.  KETERANGAN
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    1. Setelah selesai dilakukan perjalanan dinas ini segera membuat lapoan kepada kami.
                    <br>2. SPT ini mulai berlaku sejak tanggal dikeluarkan.
                </td>
            </tr>
        </table>
    </div>

    <br>

    <div class="body font-12">
        {{ $data->dalam_rangka_nota_dinas }}
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

</body>
</html>
