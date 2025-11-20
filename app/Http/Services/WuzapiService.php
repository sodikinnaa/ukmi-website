<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class WuzapiService{
    public function __construct(){
        $this->enpoint = env('WUZ_URL');
        $this->token_wuz = env('WUZ_TOKEN_APPS');
    }

    public function send_message($phone, $body)
    {
        $url = $this->enpoint . 'chat/send/text';
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Content-Type' => 'application/json',
            'token' => $this->token_wuz,
        ])->post($url, [
            'Phone' => $phone,
            'Body' => $body,
        ]);

        return $response->json();
    }

    public function phone_clean($phone, $country){
        $phone = trim($phone);

        // Hilangkan spasi, strip, dan tanda plus
        $phone_sanitized = preg_replace('/[^0-9]/', '', $phone);

        // Pastikan kode negara dua digit (contoh: 62)
        // Cek jika dimulai dengan '08' -> ganti jadi '62'
        if (strpos($phone_sanitized, '08') === 0) {
            $phone_sanitized = '62' . substr($phone_sanitized, 1);
        }
        // Jika sudah dimulai 62, biarkan

        return [
            'phone' => $phone_sanitized,
            'country' => $country,
        ];
    }   

    public function phone_verfify($phones)
    {
        // Normalize $phones to array
        if (!is_array($phones)) {
            $phones = [$phones];
        }

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'token' => $this->token_wuz,
            'Content-Type' => 'application/json',
        ])->post($this->enpoint . 'user/check', [
            'Phone' => $phones,
        ]);

        $result = $response->json();

        // Ambil data IsInWhatsapp
        $isinwhatsapp = null;
        // dd($result);
        if (
            isset($result['code']) && $result['code'] == 200 &&
            isset($result['data']['Users']) && is_array($result['data']['Users']) &&
            count($result['data']['Users']) > 0 &&
            isset($result['data']['Users'][0]['IsInWhatsapp'])
        ) {
            $isinwhatsapp = $result['data']['Users'][0]['IsInWhatsapp'];
        }

        return $isinwhatsapp;
    }
}