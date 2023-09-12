<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Dibuat Pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resident as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->id_number }}</td>
                <td> {{ Carbon\Carbon::parse($value->date_of_birth)->format('d F Y') }}</td>
                <td>
                    {{ $value->address }}, {{ $value->city->name }}, {{ $value->province->name }}
                </td>
                <td>
                    {{ $value->gender }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($value->created_at)->format('d F Y h:i:s') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
