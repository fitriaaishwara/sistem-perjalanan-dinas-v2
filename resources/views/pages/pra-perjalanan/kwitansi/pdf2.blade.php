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
            padding-top: 2rem;
            padding-bottom: 2rem;
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
    <div class="text-center font-11">
        <h2>RINCIAN BIAYA PERJALANAN DINAS</h2>
    </div>

    <br>

    <div>
        <p class="font-12">Lampiran SPD Nomor &nbsp;&nbsp;&nbsp;:<br>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </p>
    </div>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td>No.</td>
                <td><div class="text-center font-11">PERINCIAN DATA</div></td>
                <td><div class="text-center font-11">JUMLAH</div></td>
                <td>
                    <div class="text-center font-11">KETERANGAN</div>
                </td>
            </tr>
            <tr>
                <td><br><br></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1.</td>
                <td>Transport</td>
                <td>Rp. 100.000,00</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <ul>
                        <li>Tiket</li>
                        <li>Taxi</li>
                    </ul>
                </td>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>
                    Uang Harian
                </td>
                <td>Rp. 100.000,00</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <ul>
                        <li>3 Hari X Rp.450.000</li>
                    </ul>
                </td>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3.</td>
                <td>
                    Penginapan
                </td>
                <td>Rp. 100.000,00</td>
                <td></td>
            </tr>
            <tr>
                <td>
                    {!!( Str::repeat('<br>', 5) )!!}
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td>Terbilang:</td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td></td>
                <td>Jakarta,</td>
            </tr>
            <tr>
                <td>Telah Dibayar Sejumlah</td>
                <td>Telah menerima jumlah uang sebesar</td>
            </tr>
            <tr>
                <td>Rp.</td>
                <td>Rp.</td>
            </tr>
            <tr>
                <td>Bendahara Pengeluaran</td>
                <td></td>
            </tr>
            <tr>
                <td>Deputi Bidang Kewirausahaan</td>
                <td>Yang menerima,</td>
            </tr>
            <tr>
                <td> {!!( Str::repeat('<br>', 5) )!!}</td>
                <td></td>
            </tr>
            <tr>
                <td>(GLEGER SANTOSO)</td>
                <td>(.............................................)</td>
            </tr>
            <tr>
                <td>NIP.</td>
                <td>NIP.</td>
            </tr>
        </table>
    </div>

    <hr style="border: 1px solid #000000;">

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td>PERHITUNGAN SPD RAMPUNG</td>
                <td></td>
            </tr>
            <tr>
                <td>Ditetapkan sejumlah :</td>
                <td>Setuju dibebankan pada</td>
            </tr>
            <tr>
                <td>Yang telah dibayar semula :</td>
                <td>Mata Anggaran Berkenaan</td>
            </tr>
            <tr>
                <td>Sisa kurang/lebih :</td>
                <td>an. Kuasa Pengguna Anggaran</td>
            </tr>
            <tr>
                <td></td>
                <td>Pejabat Pembuat Komitmen</td>
            </tr>
            <tr>
                <td></td>
                <td>Deputi Bidang Kewirausahaan</td>
            </tr>
            <tr>
                <td></td>
                <td>{!!( Str::repeat('<br>', 5) )!!}</td>
            </tr>
            <tr>
                <td></td>
                <td>DESTRY ANNA SARI, SH</td>
            </tr>
            <tr>
                <td></td>
                <td>NIP.</td>
            </tr>
        </table>
    </div>



    <style>
        table, th, td {
            border: 1px solid rgb(8, 8, 8);
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</body>
</html>
