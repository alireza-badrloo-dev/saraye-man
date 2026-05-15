<?php

namespace  App\Services;



use Illuminate\Support\Facades\Http;

class SmsService 
{
    protected $apiKey;
    protected $lineNumber;

    public function __construct()
    {
        $this->apiKey = config('services.smsir.api_key');
        $this->lineNumber = config('services.smsir.line_number');
    }

    // ارسال پیامک خوش آمدگویی
    public function sendWelcomeSms($mobile)
    {
        return $this->sendLikeToLike(
            ["خوش آمدید! از اینکه کنار ما هستید خوشحالیم 🤝"],
            [$mobile]
        );
    }

    // تابع عمومی برای ارسال پیامک LikeToLike
    public function sendLikeToLike(array $messages, array $mobiles)
    {
        $response = Http::withHeaders([
            'Accept' => 'text/plain',
            'Content-Type' => 'application/json',
            'X-API-KEY' => $this->apiKey,
        ])->post('https://api.sms.ir/v1/send/likeToLike', [
            'lineNumber' => $this->lineNumber,
            'messageTexts' => $messages,
            'mobiles' => $mobiles,
            'senddatetime' => null,
        ]);

        return $response->json();
    }
}
