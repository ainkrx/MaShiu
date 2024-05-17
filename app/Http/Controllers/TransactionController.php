<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function transactionPage () {
        $transactions = Transaction::where('user_id',auth()->user()->id)->orderBy('date', 'desc')->get();
        return view('transaction', ['transactions' => $transactions]);
    }

    public function addTransaction (Request $req) {
        $user_id = auth()->user()->id;
        $cart = auth()->user()->cart;

        $total_price = 0;
        $total_quantity = 0;
        foreach ($cart->items as $item){
            if ($item->pivot->status == 'on') {
                $total_price += $item->pivot->quantity * $item->price;
                $total_quantity += $item->pivot->quantity;
            }
        }

        if ($total_quantity === 0) return redirect('home');

        $transaction_id = DB::table('transactions')->insertGetId([
            'user_id' => $user_id,
            'total_transaction'=> $total_price,
            'payment_type' => $req->payment_type,
            'date' => Carbon::now()
        ]);

        $transaction = Transaction::where('id', $transaction_id)->first();
        foreach ($cart->items as $item){
            if ($item->pivot->status == 'on') {
                $transaction->items()->attach(
                    $item->id, ['quantity'=>$item->pivot->quantity]
                );
                $item->stock -= $item->pivot->quantity;
                $item->save();
                $cart->items()->detach($item->id);
            }
        }

        $cur_points = auth()->user()->points;
        $new_points = $cur_points + ($total_price / 10);
        if ($req->payment_type == 'Points') {
            $new_points -= $total_price;
        }
        User::where('id', $user_id)->update([
            'points' => $new_points
        ]);

        $success = 'Transaction Success!';
        if (Session::get('locale') == 'id') {
            $success = 'Transaksi Sukses!';
        }
        return redirect('/history')->with(['success' => $success]);
    }
}
