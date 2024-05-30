@extends('layouts.dashboard')

@section('content')
<div class="iq-card iq-card-block iq-card-stretch iq-card-height-half">
    <div class="iq-card-body">
        <div class="row">
            <div class="col-lg-12">
                <span class="text-success float-right"><i class="ri-arrow-up-fill"></i></span>
                <span class="font-size-14">MQ2</span>
                <h3></h3>
                <div class="iq-progress-bar-linear d-inline-block w-100 float-left mt-3">
                    <div class="iq-progress-bar">
                        <span class="bg-primary" data-percent="90"
                            style="transition: width 2s ease 0s; width: 90%;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch iq-card-height-half">
    <div class="iq-card-body">
        <div class="row">
            <div class="col-lg-12">
                <span class="text-success float-right"><i class="ri-arrow-up-fill"></i></span>
                <span class="font-size-14">DHT11</span>
                <h3></h3>
                <div class="iq-progress-bar-linear d-inline-block w-100 float-left mt-3">
                    <div class="iq-progress-bar">
                        <span class="bg-primary" data-percent="90"
                            style="transition: width 2s ease 0s; width: 90%;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
