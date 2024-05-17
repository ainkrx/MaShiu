@extends('layouts.main')

@section('title', 'Home')

@section('container')
    <div class="container carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('img/banner/1.png') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/banner/2.png') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/banner/3.png') }}" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">{{__('button.previous')}}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">{{__('button.next')}}</span>
            </button>
          </div>
    </div>
    <div class="wrapper1">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h1 class="text">{{__('text.home')}}</h1>
            </div>
        </div>
        <div class="forms1">
            <form class="d-flex">
                <input class="form-control me-2" type="search" name="search" placeholder="{{__('form.input.search')}}" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="card-deck">
            @foreach ($items as $item)
                <div class="card" style="width: 18rem;">
                    <div class="item-image">
                        <img src="{{Storage::url('images/'.$item->image)}}" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">Rp{{ number_format($item->price, 2, ',', '.') }}</p>
                        <a href="/item/view/{{ $item->id }}" class="btn btn-primary">{{__('button.detail')}}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="next">
            <nav aria-label="Page navigation example" class="justify-content-center">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{ $items->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">{{__('button.previous')}}</span>
                        </a>
                    </li>

                    @for ($i =1 ; $i <= $items->lastPage() ; $i++)
                        @if ($i == $items->currentPage())
                            <li class="page-item"><a style="color:red; font-weight:bold" class="page-link" href="{{ $items->url($i) }}"> {{ $i }}</a></li>
                        @else
                            <li class="page-item"><a href="{{ $items->url($i) }}" class="page-link">{{ $i }} </a></li>
                        @endif
                    @endfor

                    <li class="page-item">
                        <a class="page-link" href="{{ $items->nextPageurl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">{{__('button.next')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <style>
        .card-deck{
            display: flex;
            justify-content: flex-start;

        }
        #search{
            width : 1100px;
            height: 40px;
        }
        .text-button{
            background-color: #0d6efd;
            color: white;
            height: 40px;
            margin-left: 50px;
            border-radius: 5px 5px 5px 5px;
            width: 100px;
        }
        .forms1 {
            margin: 0px 15px;
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
    </style>
@endsection
