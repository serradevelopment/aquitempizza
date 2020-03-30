<?php

// {
//     "name" : "Aqui tem pizza",
//     "short_name" : "Aqui tem pizza",
//     "description" : "Aplicativo para realizar pedidos no delivery Aqui tem Pizza",
//     "start_url" : "http://agenciadedigitadores.online/",
//     "display" : "fullscreen",
//     "orientation" : "any",
//     "lang" : "Portuguese",
//     "theme_color": "#eeff00",
//     "background_color": "#eeff00",
//     "display": "standalone",
//     "scope": "/",
//     "start_url": "/?utm_source=homescreen",
//     "lang": "pt-BR",
//     "orientation": "any",
//     "icons": [
//         {
//             "src": "/images/aquitempizza.png",
//             "sizes": "512x512",
//             "type": "image/png"
//         }
//     ]
// }
return [
    'name' => 'Aqui tem pizza',
    'manifest' => [
        'name' => env('APP_NAME', 'Aqui tem pizza'),
        'short_name' => 'Aqui tem pizza',
        'start_url' => '/',
        'background_color' => '#eeff00',
        'theme_color' => '#eeff00',
        'display' => 'standalone',
        'orientation'=> 'any',
        'icons' => [
            '512x512' => '/images/aquitempizza.png'
        ],
        'splash' => [
            '640x1136' => '/images/aquitempizza.png',
            '750x1334' => '/images/aquitempizza.png',
            '828x1792' => '/images/aquitempizza.png',
            '1125x2436' => '/images/aquitempizza.png',
            '1242x2208' => '/images/aquitempizza.png',
            '1242x2688' => '/images/aquitempizza.png',
            '1536x2048' => '/images/aquitempizza.png',
            '1668x2224' => '/images/aquitempizza.png',
            '1668x2388' => '/images/aquitempizza.png',
            '2048x2732' => '/images/aquitempizza.png',
        ],
        'custom' => []
    ]
];
