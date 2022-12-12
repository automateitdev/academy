<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/dataupdate', [ApiController::class, 'dataupdate']);
Route::post('/pdfgenerate', [ApiController::class, 'generate_pdf']);

