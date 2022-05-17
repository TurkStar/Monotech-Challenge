<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;

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

    public function assignPromotion(Request $request) {


        $promotion = Promotion::where('code', $request->code)->get();

        if ($promotion->isEmpty()) {
            return response()->json('Promotion not found', 404);
        }

        $quata_count = DB::table('user_promotions')
                            ->select('id')
                            ->where('promotion_id', $promotion[0]->id)
                            ->count();

        
        if ($quata_count + 1 > $promotion[0]->quota) {
            return "Promotion quota is full";
        }
        
        // Check if promotion already used
        $promotion_exist = DB::table('user_promotions')
        ->select('user_id')
        ->where('promotion_id', $promotion[0]->id)
        ->first();

        if ($promotion_exist) {
            if ($promotion_exist->user_id == $request->user_id) {
                return response()->json('Promotion already used', 403);
            }
        }  

        // Add promotion to user
        DB::table('user_promotions')->insert([
            'user_id' => $request->user_id,
            'promotion_id' => $promotion[0]->id
        ]);
        
        $current_balance = DB::table('wallets')
                             ->select('balance')
                             ->where('user_id', $request->user_id)
                             ->get();
                             
        // If user does not have a wallet
        if ($current_balance->isEmpty()) {

            DB::table('wallets')->updateOrInsert(
                ['user_id' => $request->user_id], ['balance' => $promotion[0]->amount]
            );

            return Response()->json(array(
                'success' => true
             ));
        }
        
        DB::table('wallets')->updateOrInsert(
            ['user_id' => $request->user_id], ['balance' => $current_balance[0]->balance + $promotion[0]->amount]
        );
 
        return Response()->json(array(
            'success' => true
          )); 

    }
    
}
