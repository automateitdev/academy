<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\PdfController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/dataupdate', [ApiController::class, 'dataupdate']);
Route::post('/pdfgenerate', [ApiController::class, 'generate_pdf']);

