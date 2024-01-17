<!DOCTYPE html>
<html>
<head>
    <title>
        Surat Perintah Tugas
        @if ($spt->nomor_spt == 1)
            Nomor :&emsp;&emsp;&emsp;SesDep.4  /SPT/         IX            2023
        @else
            Nomor :&emsp;&emsp;&emsp;Dep.4  /SPT/         IX            2023
        @endif
    </title>
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
        <u><h1>SURAT PERINTAH TUGAS</h1></u>
        @if ($spt->nomor_spt == 1)
            <p style="font-size: 12px">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;SesDep.4  /SPT/         IX            2023</p>
        @else
            <p style="font-size: 12px">Nomor :&emsp;&emsp;&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;Dep.4  /SPT/         IX            2023</p>
        @endif
    </div>

    <br>

    <div class="font-11">
        <table class="w-100">
            <tr>
                <td style="width: 30px" class="text-center">
                    I.
                </td>
                <td style="width: 250px; font-weight: bold">
                    DIPERINTAHKAN KEPADA
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                </td>
            </tr>
            @foreach($dataStaff as $item)
            <tr>
                <td style="width: 30px" class="text-center">
                </td>
                <td class="text" style="width: 100px">
                    1. Nama
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $item->staff->name }}
                </td>
            </tr>
            <tr>
                <td style="width: 30px" class="text-center">
                </td>
                <td class="text" style="width: 100px">
                    2. Jabatan
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $item->staff->jabatans->name }}
                </td>
            </tr>
            @endforeach
            <tr>
                <td style="width: 30px" class="text-center">
                    II.
                </td>
                <td style="width: 100px; font-weight: bold">
                    MAKSUD PERJALANAN
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $tujuan->perjalanan->perihal_perjalanan }}
                </td>
            </tr>
            <tr>
                <td style="width: 30px" class="text-center">
                    III.
                </td>
                <td style="width: 100px; font-weight: bold">
                    TUJUAN
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $tujuan->tempatTujuan->name }}
                </td>
            </tr>
            <tr>
                <td style="width: 30px" class="text-center">
                    IV
                </td>
                <td style="width: 100px; font-weight: bold">
                    JANGKA WAKTU
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    Tgl. Berangkat : {{ tgl_indo($tujuan->tanggal_berangkat) }}
                    <br> Tgl. Kembali : {{ tgl_indo($tujuan->tanggal_kembali) }}
                </td>
            </tr>
            <tr>
                <td style="width: 30px" class="text-center">
                    V.
                </td>
                <td style="width: 170px; font-weight: bold">
                    KETERANGAN
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
        {{-- {{ $data->dalam_rangka_nota_dinas }} --}}
    </div>

    {!!( Str::repeat('<br>', 2) )!!}

    <div class="font-11 w-100">
        <table class="w-100 tabel_spd">
            <tr>
                <td></td>
                <td style="width: 30px"></td>
                <td>
                    <div style="width: 250px; font-weight: bold">DIKELUARKAN DI : JAKARTA</div>
                    <u><div style="width: 250px; font-weight: bold">PADA TANGGAL : {{ tgl_indo($spt->dikeluarkan_tanggal) }}</div></u>
                </td>
            </tr>
        </table>
    </div>
    <br>

    <div class="font-11 w-100">
        <table class="w-100 tabel_ttd">
            <tr>
                <td></td>
                <td style="width: 30px"></td>
                <td>
                    <div style="width: 250px; font-weight: bold">Sekretaris Deputi</div>
                    <div style="width: 250px; font-weight: bold">Deputi Bidang Kewirausahaan</div>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div style="width: 250px; font-weight: bold">Bastian</div>
                    <div style="width: 250px; font-weight: bold">NIP 196904 17 199403 1 001</div>
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

                    {!!( Str::repeat('<br>', 6) )!!}

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
                    Tembusan :
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
