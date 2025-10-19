<?php

return [
    // Trust all proxies for Codespaces
    'proxies' => '*',
    
    // Trust all headers
    'headers' => [
        'forwarded' => 'FORWARDED',
        'x-forwarded-for' => 'X_FORWARDED_FOR',
        'x-forwarded-host' => 'X_FORWARDED_HOST',
        'x-forwarded-port' => 'X_FORWARDED_PORT',
        'x-forwarded-proto' => 'X_FORWARDED_PROTO',
    ],
];

