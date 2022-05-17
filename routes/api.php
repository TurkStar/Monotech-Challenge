<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PromotionCodesController;


    
    Route::get('/promotion-codes/{id}', [PromotionCodesController::class, 'show']);
    Route::get('/promotion-codes', [PromotionCodesController::class, 'index']);
    Route::post('/promotion-codes', [PromotionCodesController::class, 'store']);
    Route::post('/assign-promotion', [PromotionCodesController::class, 'assignPromotion']);
   


