<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
// foreach ($protectedSections as $section => $config) {
//     Route::prefix('admin')->middleware($config['middleware'])->group(function () use ($section, $config) {
//         Route::resource($section, $config['controller'])
//             ->names("admin.{$section}")
//             ->middleware([
//                 'index' => "can:{$section}.read",
//                 'show' => "can:{$section}.read",
//                 'create' => "can:{$section}.write",
//                 'store' => "can:{$section}.write",
//                 'edit' => "can:{$section}.write",
//                 'update' => "can:{$section}.write",
//                 'destroy' => "can:{$section}.write",
//             ]);
//     });
// }


foreach ($protectedSections as $section => $config) {
    $param = Str::singular($section); // Ej: 'categories' => 'category'
    Route::prefix('admin')->middleware($config['middleware'])->group(function () use ($section, $config, $param) {
        // Lectura
        Route::get("$section", [$config['controller'], 'index'])
            ->name("admin.$section.index")
            ->middleware("can:$section.read");
        // Route::get("$section/{{$param}}", [$config['controller'], 'show'])
        //     ->name("admin.$section.show")
        //     ->middleware("can:$section.read");

        // Escritura
        Route::get("$section/create", [$config['controller'], 'create'])
            ->name("admin.$section.create")
            ->middleware("can:$section.write");
        Route::post("$section", [$config['controller'], 'store'])
            ->name("admin.$section.store")
            ->middleware("can:$section.write");
        Route::get("$section/{{$param}}/edit", [$config['controller'], 'edit'])
            ->name("admin.$section.edit")
            ->middleware("can:$section.write");
        Route::put("$section/{{$param}}", [$config['controller'], 'update'])
            ->name("admin.$section.update")
            ->middleware("can:$section.write");
        Route::delete("$section/{{$param}}", [$config['controller'], 'destroy'])
            ->name("admin.$section.destroy")
            ->middleware("can:$section.write");
    });
}