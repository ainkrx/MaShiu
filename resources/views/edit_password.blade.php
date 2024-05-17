@extends('layouts.main')

@section('title')
    {{__('button.edit_password')}}
@endsection

@section('container')
    @if(session()->has('wrongPassword'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('wrongPassword') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-5" class="bg-danger">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">{{__('form.title.edit_password')}}</h1>
            <form action="/profile/password/update" method="post" >
                @csrf
                <div class="form-floating">
                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="old_password" required value="{{ old('old_password') }}">
                    <label for="old_password">{{__('form.input.old_password')}}</label>
                    @error('old_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="name@example.com" required value="{{ old('new_password') }}">
                    <label for="new_password">{{__('form.input.new_password')}}</label>
                    @error('new_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">{{__('button.edit_password')}}</button>
                <a href="{{ url()->previous() }}" class="w-100 btn btn-lg btn-danger mt-3">{{__('button.back')}}</a>
            </form>
        </main>
        </div>
    </div>
@endsection
