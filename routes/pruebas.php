<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::resource('/empleados', EmployeeController::class);
