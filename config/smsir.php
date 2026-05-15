<?php

return [
    'api_key' => env('SMSIR_API_KEY'),
    'template_id' => env('SMSIR_TEMPLATE_ID'),
    'base_url' => env('SMSIR_BASE_URL', 'https://api.sms.ir/v1'),
];
