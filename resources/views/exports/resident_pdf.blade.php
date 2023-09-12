<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PDF Report</title>
    <style>
        @page {
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: left;
        }
    </style>
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
</head>

<body>
    <h1 class="text-2xl font-semibold mb-4">PDF Report</h1>

    <table>
        <thead>
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nama Provinsi</th>
                <th class="px-4 py-2">Jumlah Penduduk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td class="px-4 py-2">{{ $key + 1 }}</td>
                    <td class="px-4 py-2">{{ $item->province_name }}</td>
                    <td class="px-4 py-2">{{ $item->population_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
