<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Data {{ $device->device_name }} </title>
</head>

<body>
    <h1>{{ $device->device_name }}
        <a href="/sensor" class="btn btn-primary">Kembali ke Sensor</a>
    </h1>
    @php
        $i = ($data->currentPage() - 1) * $data->perPage() + 1;
    @endphp
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DateTime</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $d->created_at }}</td>
                    <td>{{ $d->data }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>

    <!-- Tampilkan daftar halaman dan informasi halaman saat ini -->
    <div class="d-flex justify-content-center">
        {{ $data->links() }}
        <p>&nbsp&nbspHalaman : {{ $data->currentPage() }}</p>
        <p>&nbspdari {{ $data->count() }}</p>
    </div>
</body>

</html>
