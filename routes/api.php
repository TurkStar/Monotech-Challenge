<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PromotionCodesController;


    Route::get('/promotion-codes', [PromotionCodesController::class, 'index']);


