<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionCodesController extends Controller
{
    public function index() {
        return Promotion::with('user')->get();
    }
}
