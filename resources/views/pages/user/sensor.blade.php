@extends('layouts.dashboard')

@section('content')
    <h1>Manage Devices</h1>


    <!-- Add Device Button -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDeviceModal">
        Add Device
    </button>

    <!-- Device Table -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Device Name</th>
                <th scope="col">Current Value</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($devices as $index => $device)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $device->id }}</td>
                    <td>{{ $device->device_name }}</td>
                    <td>{{ $device->current_value }}</td>
                    <td>
                        <!-- Update Button -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateDeviceModal-{{ $device->id }}">
                            Update
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('devices.destroy', $device->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Update Device Modal -->
                <div class="modal fade" id="updateDeviceModal-{{ $device->id }}" tabindex="-1" role="dialog" aria-labelledby="updateDeviceModalLabel-{{ $device->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateDeviceModalLabel-{{ $device->id }}">Update Device</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('devices.update', $device->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="device_name_{{ $device->id }}">Device Name</label>
                                        <input type="text" class="form-control" id="device_name_{{ $device->id }}" name="device_name" value="{{ $device->device_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="current_value_{{ $device->id }}">Current Value</label>
                                        <input type="number" class="form-control" id="current_value_{{ $device->id }}" name="current_value" value="{{ $device->current_value }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Add Device Modal -->
    <div class="modal fade" id="addDeviceModal" tabindex="-1" role="dialog" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeviceModalLabel">Add Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('devices.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="device_name">Device Name</label>
                            <input type="text" class="form-control" id="device_name" name="device_name" required>
                        </div>
                        <div class="form-group">
                            <label for="current_value">Current Value</label>
                            <input type="number" class="form-control" id="current_value" name="current_value" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
