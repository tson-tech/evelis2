<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TransferLedger;
use App\Events\TransferExecuted;
use App\Http\Controllers\Controller;

class TransferController extends Controller
{
    //

    public function index()
    {

      $ledgers = TransferLedger::all();
        if($ledgers->count() > 0)
        {

           return response()->json ([
               'status' => 200,
               'ledgers' => $ledgers
              ], 200);

        }

        else

        {

           return response()->json ([
               'status' => 404,
               'message' => 'No records found'
              ], 404);
        } 
    }



    public function store(Request $request)
    {
        $ledger = TransferLedger::create([
            'customer_id' => $request->customer_id,
            'tran_type' => '0',
            'src_account' => $request->src_account,
            'dst_account' => $request->dst_account,
            'amount' => $request->amount
        ]);

        event(new TransferExecuted($ledger));

        if($ledger){

            return response()->json([
                'status' => 200,
                'message' => "Ledger added successfully"
            ],200);
            }else {
                
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ],500);
            }
    }
}
