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
                    <td class="font-12">Hotel           : {{ rupiah($data->tujuan_perjalanan[0]->tempatTujuan->hotel[0]->nominal) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-12">Tiket       : {{ rupiah($data->tujuan_perjalanan[0]->tempatTujuan->tiket[0]->nominal) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-12">Transport      : {{ rupiah($data->tujuan_perjalanan[0]->tempatTujuan->translok[0]->nominal) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-12">Total      : {{ rupiah($data->tujuan_perjalanan[0]->tempatTujuan->hotel[0]->nominal +
                    $data->tujuan_perjalanan[0]->tempatTujuan->tiket[0]->nominal +  $data->tujuan_perjalanan[0]->tempatTujuan->translok[0]->nominal) }}</td>
                </tr>
            </tbody>
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
