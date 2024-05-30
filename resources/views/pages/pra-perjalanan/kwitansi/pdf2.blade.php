<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

    <style>
        .body {
            text-indent: 25px;
            text-align: justify;
        }

        .text {
            text-indent: 10px;
            text-align: justify;
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
            table-layout: fixed; /* this keeps your columns with at the defined width */
            display: table;
            width: 100%;
        }

        .tabel_ttd td {
            width: calc(100% / 3);
        }

        .tabel_spd {
            table-layout: fixed; /* this keeps your columns with at the defined width */
            display: table;
            width: 100%;
        }

        .tabel_spd td {
            width: calc(100% / 3);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }

        .no-border {
            border: none;
        }



        /* Mengatur gaya untuk baris atau kolom tertentu */
        .row-no-border td {
            border-top: none;
            border-bottom: none;
        }

        .col-no-border {
            border-left: none;
            border-right: none;
        }

        .no-border-bottom {
        border-bottom: none;
    }
    </style>
</head>
<body>
    <div class="text-center font-11">
        <h2>RINCIAN BIAYA PERJALANAN DINAS</h2>
    </div>

    <br>

    <div>
        <p class="font-12">Lampiran SPD Nomor &nbsp;&nbsp;&nbsp;:<br>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </p>
    </div>
    <div class="font-11">
        <table class="w-100 table  tbl">
            <tbody>
                <tr>
                    <td class="text-center p-sm-2" style="width: 5%">No.</td>
                    <td class="text-center p-sm-2 ">PERINCIAN BIAYA</td>
                    <td class="text-center p-sm-2" style="width: 20%">JUMLAH</td>
                    <td class="text-center p-sm-2">KETERANGAN</td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 5%; border-bottom: none"><br><br>1.</td>
                    <td class="p-sm-2" style="border-bottom: none">
                        <br><br>Transport
                        @php
                            $totalTransport = 0;
                        @endphp
                        @foreach($kwitansi->transportasi_berangkat as $transportBerangkat)
                            @php
                                $totalTransport += $transportBerangkat->nominal;
                            @endphp
                            <br>
                            - {{ $transportBerangkat->deskripsi_file }} {{ format_rupiah($transportBerangkat->nominal) }}
                        @endforeach
                        <br>
                        @foreach($kwitansi->transportasi_pulang as $transportPulang)
                            @php
                                $totalTransport += $transportPulang->nominal;
                            @endphp
                            - {{ $transportPulang->deskripsi_file }} {{ format_rupiah($transportPulang->nominal) }}
                        @endforeach
                    </td>
                    <td class="text-center p-sm-2" style="width: 20%;border-bottom: none; border-top: none"><br><br>{{ format_rupiah($totalTransport) }}</td>
                    <td class="p-sm-2"style="border-bottom: none; border-top: none"></td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 5%; border-bottom: none; border-top: none">2.</td>
                    <td class="p-sm-2" style="border-bottom: none; border-top: none">Uang Harian
                        @php
                            $totalUangHarian = 0;
                        @endphp
                        @foreach($kwitansi->tujuan_perjalanan as $tujuanPerjalanan)
                            @php
                                $subtotal = $tujuanPerjalanan->lama_perjalanan * $tujuanPerjalanan->uangHarian->nominal;
                                $totalUangHarian += $subtotal;
                            @endphp
                            <br>
                            {{ $tujuanPerjalanan->lama_perjalanan }} hari X {{ format_rupiah($tujuanPerjalanan->uangHarian->nominal) }}
                        @endforeach
                    </td>
                    <td class="text-center p-sm-2" style="width: 20%;border-bottom: none; border-top: none">{{ format_rupiah($totalUangHarian) }}</td>
                    <td class="p-sm-2" style="border-bottom: none; border-top: none"></td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 5%; border-bottom: none; border-top: none">3.</td>
                    <td class="p-sm-2" style="border-bottom: none; border-top: none">Penginapan
                        <br>
                        @php
                            $totalAkomodasiHotel = 0;
                        @endphp
                        @foreach($kwitansi->akomodasi_hotel as $akomodasiHotel)
                            @php
                                // Calculate the total cost considering the duration of stay
                                $totalAkomodasiHotel += $akomodasiHotel->nominal * ($kwitansi->tujuan_perjalanan[0]->lama_perjalanan - 1);
                            @endphp
                            <br>
                            - {{ $akomodasiHotel->deskripsi_file }} {{ format_rupiah($akomodasiHotel->nominal * ($kwitansi->tujuan_perjalanan[0]->lama_perjalanan - 1)) }}
                        @endforeach
                        {!!( Str::repeat('<br>', 7) )!!}
                    </td>
                    <td class="text-center p-sm-2" style="width: 20%; border-bottom: none; border-top: none">{{ format_rupiah($totalAkomodasiHotel) }}</td>
                    <td class="p-sm-2" style="width: 20%; border-bottom: none; border-top: none"></td>
                </tr>
                <tr>
                    <td class="text-center p-sm-2" style="width: 5%;border-bottom: none; border-top: none"></td>
                    <td class="p-sm-2 " style="width: 30%; border-bottom: none; border-top: none">JUMLAH :</td>
                    <td class="text-center p-sm-2" style="width: 20%; border-bottom: none; border-top: none">{{ format_rupiah($totalTransport + $totalUangHarian + $totalAkomodasiHotel) }}</td>
                    <td class="p-sm-2" style="width: 20%; border-bottom: none; border-top: none"></td>
                </tr>
                <tr >
                    <td class="p-sm-2 " style="width: 5%" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Terbilang: {{ terbilang($totalTransport + $totalUangHarian + $totalAkomodasiHotel) }}</td>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="font-11 w-100">
            <table style="border: none;">
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Jakarta,</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Telah Dibayar Sejumlah</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Telah menerima jumlah uang sebesar</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">{{ format_rupiah($totalTransport + $totalUangHarian + $totalAkomodasiHotel) }}</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">{{ format_rupiah($totalTransport + $totalUangHarian + $totalAkomodasiHotel) }}</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Bendahara Pengeluaran</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Deputi Bidang Kewirausahaan</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Yang menerima,</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">{!!( Str::repeat('<br>', 3) )!!}</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">(GLEGER SANTOSO)</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">({{ $kwitansi->staff->name }})</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">NIP.</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">NIP. {{ $kwitansi->staff->nip }}  </td>
                </tr>
            </table>
        </div>

        <hr style="border: 1px solid #000000;">

        <div class="font-11 w-100">
            <table style="border: none;">
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">PERHITUNGAN SPD RAMPUNG</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Ditetapkan sejumlah : {{ format_rupiah($totalTransport + $totalUangHarian + $totalAkomodasiHotel) }}</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Setuju dibebankan pada</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Yang telah dibayar semula : {{ format_rupiah($totalTransport + $totalUangHarian + $totalAkomodasiHotel) }}</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Mata Anggaran Berkenaan</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Sisa kurang/lebih :</td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">an. Kuasa Pengguna Anggaran</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Pejabat Pembuat Komitmen</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">Deputi Bidang Kewirausahaan</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">{!!( Str::repeat('<br>', 5) )!!}</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">DESTRY ANNA SARI, SH</td>
                </tr>
                <tr>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none"></td>
                    <td style="border-bottom: none; border-top: none; border-right: none; border-left: none">NIP.</td>
                </tr>
            </table>
        </div>



        <style>
            table, th, td {
                border: 1px solid rgb(8, 8, 8);
                border-collapse: collapse;
                width: 100%;
            }

            .tables {
                border: 1px solid rgb(255, 255, 255);
                border-collapse: collapse;
                width: 100%;
            }
        </style>

    </div>

    <br>
</body>
</html>
