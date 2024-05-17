@extends('layouts.main')

@section('title')
    {{__('button.cart')}}
@endsection

@section('container')
    <div class="wrapper1">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h1 class="text">{{__('text.cart.title')}}</h1>
            </div>
        </div>
        <div class="checkout">
            <h3>{{__('text.total_price')}}: Rp{{number_format($total_price, 2, ',', '.')}}</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">{{__('button.check_out')}} ({{$total_quantity}})</button>
        </div>
        <div class="card-deck">
            @forelse ($items as $item)
                <div class="card" style="width: 18rem;">
                    <div class="item-image">
                        <img src="{{Storage::url('images/'.$item->image)}}" class="card-img-top" alt="...">
                    </div>
                    <form action="/cart/edit">
                        @if ($item->pivot->quantity > $item->stock)
                            <div class="card-body gray">
                        @else
                            <div class="card-body">
                        @endif
                                <h5 class="card-title">{{ $item->name }} <br></h5>
                                <h6 class="card-text">Rp{{ number_format($item->price, 2, ',', '.') }}</h6>
                                <h6 class="card-text">{{__('form.input.quantity')}}: {{ $item->pivot->quantity }}</h6>
                                <h6 class="card-text">{{__('text.total_price')}}: Rp{{ number_format($item->price * $item->pivot->quantity, 2, ',', '.') }}</h6>
                                <a href="/item/view/{{ $item->id }}" class="btn btn-primary">{{__('button.update_cart')}}</a>
                                <a href="/cart/remove/{{ $item->id }}" class="btn btn-danger">{{__('button.remove_cart')}}</a>
                                <input type="hidden" name="item_id" value={{ $item->id }}>
                                @if ($item->pivot->status == 'on' && $item->pivot->quantity <= $item->stock)
                                    <input type="checkbox" name="status" class="checkbox" value='true' checked onchange="this.form.submit();">
                                @elseif ($item->pivot->quantity <= $item->stock)
                                    <input type="checkbox" name="status" class="checkbox" value='false' onchange="this.form.submit();">
                                @endif
                            </div>
                    </form>
                </div>
            @empty
                <div class="box">
                    <div class="empty">
                        <img src="{{Storage::url('images/cart.png')}}" class="cart-img" alt="cart_image">
                        <br>
                    </div>
                    <div class="empty">
                        <h1 class="" style="margin: 0 auto"><b>{{__('text.cart.empty')}}<b></h1>
                        <h3 style="text-align: center">{{__('text.cart.empty_2')}} <br>{{__('text.cart.empty_3')}}</h3>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">{{__('form.title.payment')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/checkOut">
                @csrf
                <div class="modal-body">
                        @if (auth()->user()->points >= $total_price)
                            <input type="radio" name="payment_type" id="" value="Points"> Points <br>
                            &nbsp;&nbsp;&nbsp; {{__('text.payment.points')}} <br>
                        @else
                            <input type="radio" name="payment_type" id="" value="Points" disabled> {{__('form.input.points')}} <br>
                            &nbsp;&nbsp;&nbsp; {{__('text.payment.points_less')}} {{ number_format(auth()->user()->points, '0', ',', '.') }} <br>
                        @endif
                        <input type="radio" name="payment_type" id="" value="COD" checked> {{__('form.input.cod')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{__('button.cancel')}} </button>
                    <button type="submit" class="btn btn-primary"> {{__('button.proceed')}} </button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <style>
        .box{
            padding-top: 50px;
            display: flex;
            flex-direction: column;
            margin: auto;
        }
        .checkbox {
            margin: 10px 50% 0px 50%;
        }
        .empty{
            gap: 7px;
            display: flex;
            flex-direction: column;
            margin: auto;
        }
        .cart-img{
            max-width: 250px;
            max-height: 250px;
        }
        .checkout{
            display: flex;
            flex-direction: row;
            gap: 20px;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .card-deck{
            display: flex;
            justify-content: flex-start;

        }
        .text{
            text-align: center;
            font-size: 35px;
            margin-bottom: 20px;
        }
        .wrapper1{
            width:1280px;
            display: flex;
            flex-direction: column;
            margin :auto;
        }
        .next{
            display: flex;
            text-align: center;
            justify-content: center;
            padding-top: 20px;
        }
        .gray {
            background-color: gray;
        }
    </style>
@endsection
