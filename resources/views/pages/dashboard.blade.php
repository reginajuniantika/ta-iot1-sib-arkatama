@extends('layouts.dashboard')

@section('content')
    <div id="temperatureChart" style="width: 100%; height: 400px;"></div>
    <div id="humidityChart" style="width: 100%; height: 400px;"></div>
    <div id="gasChart" style="width: 100%; height: 400px;"></div>
    <div id="rainChart" style="width: 100%; height: 400px;"></div>
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        let temperatureChart, humidityChart, gasChart, rainChart;
        const baseUrl = '{{ url('') }}';

        async function requestData() {
            let endpoint = `${baseUrl}/api/data`;
            let params = {
                limit: 4
            }; // Membatasi jumlah data untuk testing

            try {
                const result = await fetch(`${endpoint}`);
                if (result.ok) {
                    const data = await result.json();
                    console.log('Fetched data:', data); // Debugging: log fetched data

                    if (Array.isArray(data)) {
                        let temperatureData = [],
                            humidityData = [],
                            gasData = [],
                            rainData = [];

                        data.forEach((sensorData) => {
                            let x = new Date(sensorData.created_at).getTime();
                            let y = Number(sensorData.data);
                            console.log(
                            `Device ID: ${sensorData.device_id}, X: ${x}, Y: ${y}`); // Debugging: log each point

                            switch (sensorData.device_id) {
                                case 3:
                                    temperatureData.push([x, y]);
                                    break;
                                case 2:
                                    humidityData.push([x, y]);
                                    break;
                                case 4:
                                    gasData.push([x, y]);
                                    break;
                                case 5:
                                    rainData.push([x, y]);
                                    break;
                            }
                        });

                        console.log('Temperature Data:', temperatureData); // Debugging: log temperature data
                        console.log('Humidity Data:', humidityData); // Debugging: log humidity data
                        console.log('Gas Data:', gasData); // Debugging: log gas data
                        console.log('Rain Data:', rainData); // Debugging: log rain data

                        // Add data to charts
                        temperatureData.forEach(point => {
                            temperatureChart.series[0].addPoint(point, true, temperatureChart.series[0].data
                                .length > 20);
                        });
                        humidityData.forEach(point => {
                            humidityChart.series[0].addPoint(point, true, humidityChart.series[0].data.length >
                                20);
                        });
                        gasData.forEach(point => {
                            gasChart.series[0].addPoint(point, true, gasChart.series[0].data.length > 20);
                        });
                        rainData.forEach(point => {
                            rainChart.series[0].addPoint(point, true, rainChart.series[0].data.length > 20);
                        });
                    } else {
                        console.error('API response is not an array');
                    }
                } else {
                    console.error('Failed to fetch data from API');
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            } finally {
                // Set timeout to fetch data again after 5 seconds
                setTimeout(requestData, 5000);
            }
        }

        // Inisialisasi grafik setelah requestData dipanggil
        window.addEventListener('load', function() {
            requestData();

            temperatureChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'temperatureChart',
                    type: 'spline',
                },
                title: {
                    text: 'Temperature'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Temperature (°C)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Temperature',
                    data: []
                }]
            });

            humidityChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'humidityChart',
                    type: 'spline',
                },
                title: {
                    text: 'Humidity'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Humidity (%)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Humidity',
                    data: []
                }]
            });

            gasChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'gasChart',
                    type: 'spline',
                },
                title: {
                    text: 'Gas'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Gas (ppm)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Gas',
                    data: []
                }]
            });

            rainChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'rainChart',
                    type: 'spline',
                },
                title: {
                    text: 'Rain'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Rain (mm)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Rain',
                    data: []
                }]
            });
        });
    </script>
@endpush
