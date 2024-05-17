<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cartChange (Request $req) {
        $cart = auth()->user()->cart;
        if ($req->status == false) {
            $temp = 'off';
        } else {
            $temp = 'on';
        }
        DB::table('cart_item')->where('cart_id', $cart->id)->where('item_id', $req->item_id)->update([
            'status' => $temp
        ]);
        return redirect()->back();
    }

    public function cart () {
        $cart = auth()->user()->cart;
        $total_price = 0;
        $total_quantity = 0;
        $items = $cart->items;
        foreach ($items as $item) {
            if ($item->pivot->status == 'on') {
                $total_price += $item->pivot->quantity * $item->price;
                $total_quantity += $item->pivot->quantity;
            }
        }
        return view('cart', ['items' => $items, 'total_price' => $total_price, 'total_quantity' => $total_quantity]);
    }
}
