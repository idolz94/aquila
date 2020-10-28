<?php

return [
    'paths' => [
        'user_avatar' => 'uploads/user_avatar',
        'image_hocvien' => 'uploads/image_hocvien',
        'teacher_avatar' => 'uploads/teacher_avatar',
        'admin_avatar' => 'uploads/admin_avatar',
        'image_lophoc' => 'uploads/image_lophoc',
        'thumbnail_lesson' => 'uploads/thumbnail_lesson',
        'news' => 'uploads/news',
    ],
    'validate' => [
        'user_avatar' => [
            'mimes' => 'jpeg,png,jpg',
            'max_size' => 2048,
        ],
    ],
    'accept_extension' => '.jpeg,.png,.jpg',
    'default' => [
        'user_avatar' => '',
    ],
    'dimensions' => [
        'user_avatar' => [
            'original' => '',
            'thumb512' => [512, 512],
            'thumb256' => [256, 256],
            'thumb128' => [128, 128],
            'icon128' => [128, 128],
            'icon64' => [64, 64],
            'icon48' => [48, 48],
            'icon32' => [32, 32],
            'icon24' => [24, 24],
        ],
        'teacher_avatar' => [
            'original' => '',
            'thumb512' => [512, 512],
            'thumb256' => [256, 256],
            'thumb128' => [128, 128],
            'icon128' => [128, 128],
            'icon64' => [64, 64],
            'icon48' => [48, 48],
            'icon32' => [32, 32],
            'icon24' => [24, 24],
        ],
        'admin_avatar' => [
            'original' => '',
            'thumb512' => [512, 512],
            'thumb256' => [256, 256],
            'thumb128' => [128, 128],
            'icon128' => [128, 128],
            'icon64' => [64, 64],
            'icon48' => [48, 48],
            'icon32' => [32, 32],
            'icon24' => [24, 24],
        ],
        'image_hocvien' => [
            'original' => '',
        ],
        'image_lophoc' => [
            'original' => '',
        ],
        'thumbnail_lesson' => [
            'original' => '',
            'larger' => [195, 140],
        ],
        'news' => [
            'small' => [120, 120],
            'larger' => [120, 120],
        ],
    ],
    'not_resize' => [],
];
