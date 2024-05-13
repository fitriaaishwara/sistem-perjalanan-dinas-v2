<!DOCTYPE html>
<html>
<head>
    <title>Nota Dinas {{ $data->nomor_nota_dinas }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <style>
        body {
            padding: 6rem 2rem;
            font-family: "Arial";
        }

        .font-11 {
            font-size: 11px;
        }

        .font-12 {
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .tbl {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .tbl th, .tbl td {
            border: 1px solid black;
            padding: 5px;
        }

        .w-100 {
            width: 100%;
        }

        .tabel_ttd {
            table-layout: fixed;
            width: 100%;
        }

        .tabel_ttd td {
            width: calc(100% / 3);
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
                <td style="width: 100px">Yth</td>
                <td style="width: 30px" class="text-center">:</td>
                <td>{{ $data->yth }}</td>
            </tr>
            <tr>
                <td>Dari</td>
                <td class="text-center">:</td>
                <td>{{ $data->dari }}</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td class="text-center">:</td>
                <td>{{ $data->perihal }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td class="text-center">:</td>
                <td>{{ $data->lampiran }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="text-center">:</td>
                <td>{{ tgl_indo($data->tanggal_nota_dinas) }}</td>
            </tr>
        </table>
    </div>

    <br>

    <div class="body font-12">
        {{ $data->isi_nota_dinas }}
    </div>

    {!! Str::repeat('<br>', 2) !!}

    @if ($data->status_nota_dinas == '1')
    <div class="font-11">
        <table class="w-100 tbl">
            <thead>
                <tr>
                    <th style="width: 30px" class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th style="width: 30px" class="text-center">Gol</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Instansi</th>
                    <th class="text-center">Tujuan</th>
                    <th class="text-center">Ket.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataStaff as $index => $value)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $value->staff->name }}</td>
                        <td class="text-center">{{ $value->staff->golongans ? $value->staff->golongans->name : '-' }}</td>
                        <td class="text-center">{{ $value->staff->jabatans ? $value->staff->jabatans->name : '-' }}</td>
                        <td>{{ $value->staff->instansis ? $value->staff->instansis->name : '-' }}</td>
                        <td>{{ $value->tujuan_perjalanan[0]->tempatTujuan->name ?? '-' }}</td>
                        <td>{{ $value->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        {{-- Your else content --}}
    @endif

    {!! Str::repeat('<br>', 2) !!}

    <div class="font-11 w-100">
        <table class="w-100 tabel_ttd">
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>Asisten Deputi</div>
                    <div>Pemetaan Data dan Analisis Usaha</div>
                    {!! Str::repeat('<br>', 4) !!}
                    <div>{{ ucfirst($data->staff->name) }}</div>
                    <div>NIP {{ $data->staff->nip }}</div>
                </td>
            </tr>
        </table>
    </div>

    <br>
    <br>
    <br>

    <div class="font-11 w-100">
        <table class="w-100">
            <tr>
                <td style="width: 250px">Tembusan :</td>
            </tr>
            @foreach ($data->tembusan as $index => $tembusan)
            <tr>
                <td style="width: 100px">{{ $tembusan->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
