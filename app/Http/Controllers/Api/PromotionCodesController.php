<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionCodesController extends Controller
{
    public function index() {

        $data = Promotion::with('users.wallet')->get();
        if (is_null($data)) {
            return response()->json('No promotion found', 404); 
        }

        return Response()->json(array(
            'success' => true,
            'data'   => $data
          )); 
    }

    public function show($id) {

        $data = Promotion::with('users.wallet')->find($id);
        if (is_null($data)) {
            return response()->json('Promotion not found', 404); 
        }

        return Response()->json(array(
            'success' => true,
            'data'   => $data
          )); 
    }

    public function store(Request $request) {

        $code = generateRandomString(3) . generateRandomNumber(3) . generateRandomString(5) . generateRandomNumber(1);

        $data = Promotion::create([
            'code' => $code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'quota' => $request->quota
        ]);

        return Response()->json(array(
            'success' => true,
            'data'   => $data
          )); 
    }
    
}
