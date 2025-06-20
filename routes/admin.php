<?php

use Illuminate\Support\Facades\Route;

$protectedSections = config('permissions.protected_sections');

// foreach ($protectedSections as $section => $config) {
//     Route::middleware($config['middleware'])->group(function () use ($section, $config) {
//         // Rutas de lectura
//         Route::middleware("can:{$section}.read")->group(function () use ($section, $config) {
//             Route::get("admin/{$section}", [$config['controller'], 'index'])->name("admin.{$section}.index");
//             Route::get("admin/{$section}/{id}", [$config['controller'], 'show'])->name("admin.{$section}.show");
//         });

//         // Rutas de escritura
//         Route::middleware("can:{$section}.write")->group(function () use ($section, $config) {
//             Route::resource("admin/{$section}", $config['controller'])
//                 ->except(['index', 'show'])
//                 ->names("admin.{$section}");
//         });
//     });
// }
foreach ($protectedSections as $section => $config) {
    Route::prefix('admin')->middleware($config['middleware'])->group(function () use ($section, $config) {
        Route::resource($section, $config['controller'])
            ->names("admin.{$section}")
            ->middleware([
                'index' => "can:{$section}.read",
                'show' => "can:{$section}.read",
                'create' => "can:{$section}.write",
                'store' => "can:{$section}.write",
                'edit' => "can:{$section}.write",
                'update' => "can:{$section}.write",
                'destroy' => "can:{$section}.write",
            ]);
    });
}