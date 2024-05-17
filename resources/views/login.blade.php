@extends('layouts.main')

@section('title')
    {{__('button.login')}}
@endsection

@section('container')
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-5">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">{{__('form.title.login')}}</h1>
            <form action="/login" method="POST">
                @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required autofocus value="{{ Cookie::get('mycookie') !== null ? Cookie::get('mycookie') : old('email')}}">
                    <label for="email">{{__('form.input.email')}}</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" required>
                    <label for="password">{{__('form.input.password')}}</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="checkbox" name="remember" id="remember" checked="{{ Cookie::get('mycookie') !== null }}"> {{__('form.input.remember_me')}}
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">{{__('button.login')}}</button>
            </form>
            <small class="d-block text-center mt-3">{{__('text.login')}} <a href="/register">{{__('button.register')}}</a></small>
        </main>
        </div>
    </div>
@endsection
