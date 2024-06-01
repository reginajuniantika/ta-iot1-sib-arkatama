@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .led-on-red {
        color: rgb(255, 0, 0);
    }

    .led-off-red {
        color: rgb(100, 0, 0);
    }

    .led-on-blue {
        color: rgb(0, 0, 255);
    }

    .led-off-blue {
        color: rgb(0, 0, 100);
    }
</style>

<div class="container my-4">
    <div class="card w-100">
        <div class="card-body">
            <div class="row my-4">
                <!-- LED Item 1 -->
                <div class="col-sm-6 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="d-flex align-items-start text-primary">
                                    <i class="fas fa-lightbulb fa-fw fa-4x led-icon led-1-icon led-off-red"></i>
                                    <div>
                                        <h6 class="p-0 m-0 fw-bold">LED 1</h6>
                                        <div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                                    onclick="toggleLed(1)">
                                                <label class="custom-control-label" for="customSwitch1">Toggle
                                                    Switch</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LED Item 2 -->
                <div class="col-sm-6 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="d-flex align-items-start text-primary">
                                    <i class="fas fa-lightbulb fa-fw fa-4x led-icon led-2-icon led-off-blue"></i>
                                    <div>
                                        <h6 class="p-0 m-0 fw-bold">LED 2</h6>
                                        <div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch2"
                                                    onclick="toggleLed(2)">
                                                <label class="custom-control-label" for="customSwitch2">Toggle
                                                    Switch</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include the MQTT.js library -->
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const brokerUrl = 'wss://v188ffd8.ala.asia-southeast1.emqxsl.com:8084/mqtt'; // Adjust the broker URL and port as necessary
        const topicPrefix = 'esp32/led';

        const options = {
            username: 'reginajuniantika',
            password: 'Regina124#',
            protocol: 'wss',
            rejectUnauthorized: false // Important if using self-signed certificates
        };

        const client = mqtt.connect(brokerUrl, options);

        client.on('connect', function () {
            console.log('Connected to MQTT broker');
        });

        client.on('error', function (err) {
            console.error('Connection error: ', err);
        });

        window.toggleLed = function (ledId) {
            var icon = document.querySelector('.led-' + ledId + '-icon');
            var ledSwitch = document.getElementById('customSwitch' + ledId);
            if (icon && ledSwitch) {
                if (ledSwitch.checked) {
                    icon.classList.remove('led-off-red', 'led-off-blue');
                    if (ledId === 1) {
                        icon.classList.add('led-on-red');
                    } else if (ledId === 2) {
                        icon.classList.add('led-on-blue');
                    }
                } else {
                    icon.classList.remove('led-on-red', 'led-on-blue');
                    if (ledId === 1) {
                        icon.classList.add('led-off-red');
                    } else if (ledId === 2) {
                        icon.classList.add('led-off-blue');
                    }
                }

                const state = ledSwitch.checked ? 'on' : 'off';
                client.publish(`${topicPrefix}/${ledId}`, JSON.stringify({
                    led: ledId,
                    state: state
                }));
                console.log(`LED ${ledId} is ${state}`);
            }
        };
    });
</script>
@endsection
