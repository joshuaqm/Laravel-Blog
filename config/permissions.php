<?php

return [
    'protected_sections' => [
        'posts' => [
            'controller' => App\Http\Controllers\Admin\PostController::class,
            'middleware' => ['auth'],
        ],
        'categories' => [
            'controller' => App\Http\Controllers\Admin\CategoryController::class,
            'middleware' => ['auth'],
        ],
        'tags' => [
            'controller' => App\Http\Controllers\Admin\TagController::class,
            'middleware' => ['auth'],
        ],
        'users' => [
            'controller' => App\Http\Controllers\Admin\UserController::class,
            // 'middleware' => ['auth', 'can:users.access'],
            'middleware' => ['auth'],
        ],
    ],
];