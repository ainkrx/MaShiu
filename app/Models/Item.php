<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function cart(){
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    public function transaction(){
        return $this->belongsToMany(Transaction::class)->withPivot('quantity');
    }
}
