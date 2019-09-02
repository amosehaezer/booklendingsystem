<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\BookTransaction;
use App\User;
use App\Book;
use Auth;

class ApiTransaction extends Controller
{
    public function borrowBook(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->total_price = 0;
            $transaction->borrow_book_date = $request->borrow_book_date;
            $transaction->return_book_date = $request->return_book_date;

            $transaction->status = 'lend';
            if($transaction->save())
            {
                $calculate_price = 0;
                $book_id = $request->id;
                $book = Book::find($book_id);
                if($book)
                {
                    $book->count = $book->count + 1;
                    $book->save();

                    $book_transaction = new BookTransaction();
                    $book_transaction->book_id = $book->id;
                    $book_transaction->save();

                    $transaction->total_price = $request->total_price;
                    $transaction->save();
                }
            }
            $status = 'success';
            $message = 'Borrow book successfully';
        }
        else
        {
            $status = 'error';
            $message = 'Borrow book failed';
        }
        return response()->json(['status' => $status, 'message' => $message], 200);
    }

    public function userTransaction(Request $request)
    {
        $status = "error";
        $message = "";
        $book_name =[];
        $data = [];
        $user = Auth::user();
        if($user)
        {
            $transaction = Transaction::select('*')->where('user_id', '=', $user->id)->orderBy('id', 'DESC')->get();
            $status = "success";
            $message = "transaction data";
            $data = $transaction;
        }
        else
        {
            $message = "not found";
        }
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], 200);
    }
    
    public function alltransaction(Request $request)
    {
        $status = "error";
        $message = "";
        $data = [];
        $transaction = Transaction::select('*')->get();
        if($transaction)
        {
            $status = "success";
            $message = "all transaction data";
            $data = $transaction;
        }
        else
        {
            $message = "No data";
        }

        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], 200);
    }
}
