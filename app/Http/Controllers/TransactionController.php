<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index');
    }
    public function store(Request $request)
    {
        $transaction_id = $request->transaction_id;
        $transaction = Transaction ::find($transaction_id);
        $transaction->status = $request->status;

        $transaction->save();
        return response()->json(['success' => 'Add new transaction successfully!']);
        
    }
    public function edit($id)
    {
        $transaction = Transaction::find();
        return response()->json($transaction);
    }
    public function destroy($id)
    {
        Transaction::find($id)->delete();
        return response()->json(['success'=> 'Delete Transaction successfully.']);
    }
}
