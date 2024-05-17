@extends('layouts.main')

@section('title')
    {{__('button.history')}}
@endsection

@section('container')
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <h1 style="text-align: center">{{__('text.history.title')}}</h1> <br>
    <div class="wrapper2">
        <?php $ctr = 1; ?>
        @forelse ($transactions as $transaction)
            <div class = wrapper1>
                <h4> {{__('text.transaction')}} #{{$ctr}} </h4>
                {{__('text.transaction_date')}}: <b>{{ $transaction->date }}</b>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('form.input.name')}}</th>
                            <th scope="col">{{__('form.input.quantity')}}</th>
                            <th scope="col">{{__('form.input.price')}}</th>
                            <th scope="col">{{__('text.sub_total')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 1; ?>
                        @foreach ($transaction->items as $item)
                            <tr>
                                <th scope="row">{{$ctr}}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>Rp{{ number_format($item->price, 2, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->price * $item->pivot->quantity, 2, ',', '.') }}</td>
                            </tr>
                            <?php $ctr += 1; ?>
                        @endforeach
                    </tbody>
                </table>
                <h4>{{__('text.total_price')}}: Rp{{ number_format($transaction->total_transaction, 2, ',', '.') }}</h4>
                {{__('text.payment.type')}}: <b> {{$transaction->payment_type}} </b>
            </div>
            <?php $ctr += 1; ?>
        @empty
            <div class="box">
                <div class="empty">
                    <img src="{{Storage::url('images/bill.png')}}" class="cart-img" alt="cart_image"> <br>
                </div>
                <div class="empty">
                    <h1 class="" style="margin: 0 auto"><b>{{__('text.history.empty')}}<b></h1>
                    <h3 style="text-align: center">{{__('text.history.empty_2')}}</h3>
                    <h3 style="text-align: center">{{__('text.history.empty_3')}}</h3>
                </div>
            </div>
        @endforelse
    </div>
    <style>
        .box{
            padding-top: 50px;
            display: flex;
            flex-direction: column;
            margin: auto;
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
        .wrapper1{
            background-color: rgb(219, 217, 217);
            display: inlin
            flex-direction: column;
            padding-left: 50px;
            padding-top: 25px;
            padding-bottom: 25px;
            margin-left:20px;
            margin-right: 20px;
            border-radius: 3px 3px 3px 3px;
        }
        .wrapper2{
            margin-left:20px;
            margin-right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>
@endsection
