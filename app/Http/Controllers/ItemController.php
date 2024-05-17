<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function getAllItems (Request $req) {
        $search = $req->search;
        $items = Item::where('name', 'LIKE', "%$search%")->paginate(8)->appends(['search' => $search]);
        return view('home', ['items' => $items]);
    }

    public function itemPage ($id) {
        $item = Item::where('id', $id)->first();
        return view('item_detail', ['item' => $item]);
    }

    public function addItemPage () {
        return view('add_item');
    }

    public function addItem (Request $req) {
        $validatedData = $req->validate([
            'name'=> 'required|unique:items|min:5|max:20',
            'description' => 'required|min:5',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:1',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $file = $req->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;
        $validatedData['image'] = $fileName;
        Item::insert($validatedData);

        Storage::putFileAs('public/images/', $file, $fileName);

        $success = 'Item successfully added!';
        if (Session::get('locale') == 'id') {
            $success = 'Barang telah ditambahkan!';
        }
        return redirect('/home')->with(['success' => $success]);
    }

    public function editCart (Request $req, $id) {
        $validatedData = $req->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if (auth()->user()->role == 'member') {
            $cart = auth()->user()->cart;
            if ($cart->items()->wherePivot('item_id', $id)->exists()) {
                $cart = auth()->user()->cart;
                $cart->items()->updateExistingPivot($id, ['quantity' => $validatedData['quantity']]);
                $cart->save();
            } else {
                $cart->items()->attach([
                    $id => ['quantity' => $validatedData['quantity']]
                ]);
            }
            return redirect('/cart');
        } else {
            $item = Item::where('id', $id)->first();
            $item->stock += $validatedData['quantity'];
            $item->save();
            return redirect('/home');
        }
    }

    public function removeFromCart ($id) {
        $cart = auth()->user()->cart;
        $cart->items()->detach($id);
        return redirect('/cart');
    }

    public function deleteItem ($id) {
        $i = Item::find($id);
        Storage::delete('public/images/'. $i->image);
        Item::where('id', $id)->delete();
        return redirect('/home');
    }
}
