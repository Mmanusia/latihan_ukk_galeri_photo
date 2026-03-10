@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="card-body p-4">
            <h1 class="h4 mb-4">Login</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="Masukkan email">
                    @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password"
                        placeholder="Masukkan password">
                    @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100" type="submit">Masuk</button>
            </form>

            <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>
        </div>
    </div>
</div>
@endsection