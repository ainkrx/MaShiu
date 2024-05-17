@extends('layouts.main')

@section('title', auth()->user()->username)

@section('container')
    @if(session()->has('editPasswordSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('editPasswordSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('editProfileSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('editProfileSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="section">
        <div class="card detail">
            <h1> {{__('button.profile')}} </h1>
            <div class="card-body">
                <div class="card-text" id="role">
                    <p>{{ auth()->user()->role }}</p>
                </div>
                <p class="card-text">
                    <b>{{__('form.input.username')}}: {{ auth()->user()->username }}</b>
                </p>
                <p class="card-text">
                    {{__('form.input.email')}}: {{ auth()->user()->email }}
                </p>
                <p class="card-text">
                    {{__('form.input.phone')}}: {{ auth()->user()->phone_number }}
                </p>
                <p class="card-text">
                    {{__('form.input.address')}}: {{ auth()->user()->address }}
                </p>
                <div class="card-footer">
                    <a href="/profile/edit" class="btn btn-primary" id="profile">{{__('button.update_profile')}}</a>
                    @if(auth()->user()->role === 'member')
                        <a href="/profile/password/edit" class="btn btn-primary" id="pw">{{__('button.edit_password')}}</a>
                    @endif
                </div>
            </div>
        </div>
        <style>
            .section{
                display : flex;
                justify-content: center;
                align-content: center;
                text-align: center;
                flex-direction: row;
            }
            .detail{
                width: 850px;
                display: flex;
                flex-direction: column;
            }
            .detail h1 {
                margin: 10px 0px;
            }
            #pw{
                background-color: white;
                border-color: rgb(96, 159, 241);
                color: rgb(96, 159, 241);
            }
            #role{
                background-color: gray;
                margin: -10px auto 5px auto;
                width: 150px;
                color: white;
                font-size: small;
                border-radius: 3px 3px 3px 3px;
                -moz-border-radius: 3px 3px 3px 3px;
                -webkit-border-radius: 3px 3px 3px 3px;
            }
            #role p {
                padding: 5px 0px;
            }
        </style>
@endsection
