@extends('layouts.main')

@section('title', $item->name)

@section('container')

<section class="section">
    <div class="card detail">
        <div class="card-img">
            <img src="{{Storage::url('images/'.$item->image)}}" class="card-img-top" alt="...">
        </div>
        <div class="card-body">
            <h5 class="card-title"><b>{{ $item->name }}</b></h5>
            <p class="card-text">{{__('text.stock')}}: {{ $item->stock }}</p>
            <h6 class="card-text">Rp{{ number_format($item->price, 2, ',', '.') }}</h6>
            <hr>
            <p class="card-text"> {{ $item->description }} </p>
            <p class="card-text"> {{ $item->quantity }} </p>
            <div class="card-footer">
                <form action="/cart/edit/{{ $item->id }}" method="POST">
                    @csrf
                    <div>
                        <h1 style="font-size: 15px; margin-left:5px;">{{__('form.input.quantity')}}: </h1>
                    </div>
                    <div class="buttons">
                        <input type="number" name="quantity" id="quantity" max={{ $item->stock }} value = {{ old('quantity') }}>
                            @error('quantity')
                                {{ $message }}
                            @enderror
                        @if (auth()->user()->role == 'admin')
                            <button type="submit" class="btn btn-primary" id="update-btn">{{__('button.add_stock')}}</button>
                        @else
                            <button type="submit" class="btn btn-primary" id="update-btn">{{__('button.update_cart')}}</button>
                        @endif
                    </div>
                    <div>
                        @if (auth()->user()->role == 'admin')
                            <a href="/item/remove/{{ $item->id }}" class="w-100 btn btn-lg btn-danger mt-3"><i class="fa fa-trash-o"></i> Remove Item</a>
                        @endif
                        <a href="{{ url()->previous() }}" class="w-100 btn btn-lg btn-danger mt-3">{{__('button.back')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<style>
    .buttons{
        display: flex;
        justify-content: center;
    }
    #quantity{
        height: 40px;
    }
    #update-btn{
        height: 40px;
        width: 200px;
        margin-left: 20px;
    }
    .card-text{
        font-size:25px;
    }
    .card-title{
        font-size: 35px;
    }
    .section{
        justify-content: center;
        display: flex;
    }
    .card-body{
        border-width: 5px;
        border-radius: 9px 9px 9px 9px;
        -moz-border-radius: 9px 9px 9px 9px;
        -webkit-border-radius: 9px 9px 9px 9px;
        border: 4px solid #b2b4b9;
        margin-left: 20px;
    }
    .card-img{
        max-width: 250px;
        max-height: 500px;
        border-width: 5px;
        border-radius: 9px 9px 9px 9px;
        -moz-border-radius: 9px 9px 9px 9px;
        -webkit-border-radius: 9px 9px 9px 9px;
        border: 4px solid #b2b4b9;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .btn-primary{
        width: 100px;
    }
    .card-img-top{
        width: 200px;
        height: 200px;
        max-width: 200px;
        min-width: 200px;
        max-height: 200px;
        min-height: 200px;
    }
    .detail{
        background-color: rgb(240, 235, 235);
        border: black;
        width: 800px;
        display: flex;
        flex-direction: row;
        padding:20px;
        border-radius: 17px 17px 17px 17px;
        -moz-border-radius: 17px 17px 17px 17px;
        -webkit-border-radius: 17px 17px 17px 17px;
        border: 0px;
    }
</style>
@endsection
