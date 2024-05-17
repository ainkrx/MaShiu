@extends('layouts.main')

@section('title')
    {{__('button.register')}}
@endsection

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-5" class="bg-danger">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">{{__('form.title.register')}}</h1>
            <form action="/register" method="post" >
                @csrf
                <div class="form-floating">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                    <label for="username">{{__('form.input.username')}}</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    <label for="email">{{__('form.input.email')}}</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                    <label for="password">{{__('form.input.password')}}</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="phone_number" class="form-control rounded-top @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="phone_number" required value="{{ old('phone_number') }}">
                    <label for="phone_number">{{__('form.input.phone')}}</label>
                    @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="address" class="form-control rounded-top @error('address') is-invalid @enderror" id="address" placeholder="address" required value="{{ old('address') }}">
                    <label for="address">{{__('form.input.address')}}</label>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">{{__('button.register')}}</button>
            </form>
            <small class="d-block text-center mt-3">{{__('text.register')}} <a href="/login">{{__('button.login')}}</a></small>
        </main>
        </div>
    </div>
@endsection
