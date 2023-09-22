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
    </style>
</head>
<body>
    <div class="text-center font-11">
        <h1>Nota Dinas</h1>
        <p>Nomor : {{ $data->nomor_nota_dinas }}</p>
    </div>

    <br>

    <div class="font-11">
        <table class="w-100">
            <tr>
                <td style="width: 100px">
                    Yth
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->yth }}
                </td>
            </tr>
            <tr>
                <td style="width: 100px">
                    Dari
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->dari }}
                </td>
            </tr>
            <tr>
                <td style="width: 100px">
                    Hal
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ $data->perihal }}
                </td>
            </tr>
            <tr>
                <td style="width: 100px">
                    Tanggal
                </td>
                <td style="width: 30px" class="text-center">
                    :
                </td>
                <td>
                    {{ tgl_indo($data->tanggal_nota_dinas) }}
                </td>
            </tr>
        </table>
    </div>

    <br>

    <div class="body font-12">
        {{ $data->isi_nota_dinas }}
    </div>

    {!!( Str::repeat('<br>', 2) )!!}

    <div class="font-11 w-100">
        <table class="w-100 tabel_ttd">
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>Asisten Deputi</div>
                    <div>Pemetaan Data dan Analisis Usaha</div>

                    {!!( Str::repeat('<br>', 4) )!!}

                    <div>Adi Trisnojuwono</div>
                    <div>NIP 19671112 199503 1 001</div>
                </td>
            </tr>
        </table>
    </div>
    <!-- Add other fields as needed -->
</body>
</html>
