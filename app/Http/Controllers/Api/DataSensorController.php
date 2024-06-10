<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DataSensorController extends Controller
{
    public function index()
    {
        return Data::orderBy('created_at', 'desc')
            ->limit(100)
            ->get();
    }

    public function store(Request $request)
    {
        $data = new Data();
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();

        if (Device::where('id', $request->device_id)->exists()) {
            $device = Device::find($request->device_id);
            $device->current_value = $request->data;
            $device->save();
        }

        if ($request->device_id == 4 && $request->data > 300) {
            $lastAlertTime = Cache::get('last_alert_time_device_4');

            // Ambang batas waktu (dalam detik) untuk menghindari spam, misalnya 300 detik (5 menit)
            $alertInterval = 300;

            // Mengecek apakah sudah lewat dari waktu interval
            if (is_null($lastAlertTime) || (time() - $lastAlertTime) > $alertInterval) {
                $this->sendAlert($request->data, $request->device_id); // Mengirim nilai gas dan ID perangkat
                // Memperbarui timestamp terakhir pengiriman alert
                Cache::put('last_alert_time_device_4', time());
            }
        }

        return response()->json(["message" => "Data telah Ditambahkan."], 201);
    }

    public function show(string $id)
    {
        return Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function web_show(string $id)
    {
        $device = Device::find($id);

        // Mengambil data sensor dengan paginasi
        $data = Data::where('device_id', $id)->orderBy('created_at', 'DESC')->simplePaginate(10); // Ganti 10 dengan jumlah data per halaman yang Anda inginkan

        return view('pages.data', [
            "title" => "Device Data",
            "device" => $device,
            "data" => $data
        ]);
    }

    private function sendAlert($gasValue, $deviceId)
    {
        $message = "Peringatan! kebocoran gas mencapai TINGKAT BERBAHAYA $gasValue pada perangkat dengan ID $deviceId";
        $message .= PHP_EOL . PHP_EOL;
        $message .= 'Dikirimkan pada tanggal ' . date('Y-m-d H:i:s') . ' oleh EcoAlert';
        $this->sendWhatsAppMessage($message);
    }

    private function sendWhatsAppMessage($message)
    {
        $token = env('FONNTE_API_TOKEN'); // Pastikan Anda sudah menambahkan token di file .env
        $phone = env('TARGET_PHONE_NUMBER'); // Pastikan Anda sudah menambahkan nomor telepon di file .env

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62', // optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token // Ganti TOKEN dengan token yang sebenarnya
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new \Exception('Curl error: ' . $error);
        }

        curl_close($curl);
        echo $response;
    }
}
