<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi</title>
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
            font-size: 14px !important;
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
    {{-- <div class="text-center font-11">
        <u><h2>SURAT PERJALANAN DINAS (SPD)</h2></u>
    </div> --}}

    <br>

    <div class="font-11">
        <table class="w-100 table table-bordered">
            <tbody>
                <tr>
                    <td></td>
                    <td class="font-12">Kode Akun           : {{ $kwitansi->perjalanan[0]->mak->kode_mak }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-12">Bukti Kas No        : {{ $kwitansi->bukti_kas_nomor }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-12">Tahun Anggaran      : {{ $kwitansi->tahun_anggaran }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="font-11">
        <table class="w-100 table table-bordered">
            <tbody>
                <tr>
                    <td colspan="2" class="font-12" style="font-weight: bold; padding-left: 260px; text-align: center">
                        <center>
                            <p style="font-weight: bold; background-color: #ffffff; border: 2px solid #030607; padding-left: 30px; padding-right: 30px; text-align: center; width:15%">
                                KUITANSI
                            </p>
                        </center>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

    <hr style="border: 2px solid #000000;">

    <div class="font-11">
        <table class="w-100 table table-bordered">
            <tbody>
                <tr>
                    <td class="font-12" style="width: 55%">Sudah terima dari</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12">{{ $kwitansi->sudah_diterima_dari }}</td>
                </tr>
                <tr>
                    <td class="font-12" style="width: 55%">Uang Sebesar</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12">Rp. {{ format_rupiah($kwitansi->tujuan_perjalanan[0]->uangHarian->nominal*$kwitansi->tujuan_perjalanan[0]->lama_perjalanan) }}</td>
                </tr>
                <tr>
                    <td class="font-12" style="width: 55%">Untuk Pembayaran</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12">Biaya Perjalanan Dinas dalam rangka <br>{{ $kwitansi->perjalanan[0]->perihal_perjalanan }}</td>
                </tr>
                <tr>
                    <td class="font-12" style="width: 55%">Berdasarkan SPD</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12"></td>
                </tr>
                <tr>
                    <td class="font-12" style="width: 55%">Nomor</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12">
                        @if($kwitansi->perjalanan[0]->nomor_spd == null)
                            -
                        @else
                            {{ $kwitansi->perjalanan[0]->nomor_spd }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-12" style="width: 55%">Tanggal</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12">
                        @if($kwitansi->perjalanan[0]->pada_tanggal == null)
                        -
                        @else
                            {{ $kwitansi->perjalanan[0]->pada_tanggal }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-12" style="width: 55%">Untuk perjalanan dinas dari</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12">
                        @if($kwitansi->tujuan_perjalanan[0] == null)
                        -
                        @else
                            {{ $kwitansi->tujuan_perjalanan[0]->tempat_berangkat }} ke: {{ $kwitansi->tujuan_perjalanan[0]->tempat_tujuan }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-12" style="width: 55%">Terbilang</td>
                    <td style="width: 10%" class="font-12 text-center">:</td>
                    <td class="font-12" style="font-weight: bold; background-color: #ffffff; border: 2px solid #030607; padding-left: 30px; padding-right: 30px; width:15%">{{ terbilang($kwitansi->tujuan_perjalanan[0]->uangHarian->nominal*$kwitansi->tujuan_perjalanan[0]->lama_perjalanan) }}</td>
                </tr>

            </tbody>

        </table>
    </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td></td>
                <td></td>
                <u><td>
                    <div class="text-center font-12">YANG MENERIMA</div>
                </td></u>
            </tr>
        </table>
    </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td></td>
                <td></td>
                <td>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div class="text-center font-12">(......................................................)</div>
                    <div class="font-12" style=" padding-left: 30px;">NIP 19751222 199903 2 001</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td></td>
                <td></td>
                <u><td>
                    <div class="text-center font-12">Tanggal:.......................................</div>
                </td></u>
            </tr>
        </table>
    </div>
    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td class="text-center font-12">Setuju dibebankan pada<br>
                mata anggaran berkenaan<br>
                an. Kuasa Pengguna Anggara<br>
                Pejabat Pembuat Komitmen<br>
                Deputi Bidang Kewirausahaan<br>
                </td>
                <td></td>
                <u><td>
                    <div class="text-center font-12">
                        LUNAS DIBAYAR<br>
                        Bendahara Pengeluaran<br>
                        Deputi Bidang Kewirausahaan<br>
                    </div>
                </td></u>
            </tr>
        </table>
    </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div class="text-center font-12" style="font-weight: bold;" >DESTRY ANNA SARI,SH</div>
                    <div class="text-center font-12">NIP 19751222 199903 2 001</div>
                </td>
                <td></td>
                <td>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div class="text-center font-12" style="font-weight: bold;">(GLEGER SANTOSO)</div>
                    <div class="text-center font-12">NIP 19751222 199903 2 001</div>
                </td>
            </tr>
        </table>
    </div>

    <style>
        table, th, td {
            border: 1px solid rgb(255, 255, 255);
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</body>
</html>
