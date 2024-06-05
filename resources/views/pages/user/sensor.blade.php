@extends('layouts.dashboard')

@section('content')
    <h1>Devices</h1>

    @php
        $i = 1;
    @endphp
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Device Name</th>
                <th scope="col">Current Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $device['id'] }}</td>
                    <td>
                        <a href="/sensor/{{ $device['id'] }}" class="device-link">{{ $device['device_name'] }}</a>
                    </td>
                    <td>{{ $device['current_value'] }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection
