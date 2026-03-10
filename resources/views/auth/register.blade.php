@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="card-body p-4">
            <h1>Register</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="namalengkap">Nama Lengkap</label>
                    <input class="form-control" id="namalengkap" type="text" name="namalengkap"
                        value="{{ old('namalengkap') }}" placeholder="Masukkan nama lengkap">
                    @error('namalengkap')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control" id="username" type="text" name="username" value="{{ old('username') }}"
                        placeholder="Masukkan username">
                    @error('username')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="Masukkan email">
                    @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="4"
                        placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password"
                        placeholder="Masukkan password">
                    @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Masukkan konfirmasi password">
                </div>

                <button class="btn btn-primary w-100" type="submit">Daftar</button>
            </form>
        </div>

    </div>
</div>
@endsection