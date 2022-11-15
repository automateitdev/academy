<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/dataupdate', [ApiController::class, 'dataupdate']);

// Route::post('/dataupdate', [ApiController::class, 'dataupdate']);
