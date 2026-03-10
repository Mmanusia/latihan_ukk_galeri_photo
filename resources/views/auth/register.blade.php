<!DOCTYPE html>
<html lang="en">
<head>
    <title>register</title>
</head>

<body>
    <h4>Register</h4>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <p>Nama Lengkap</p>
        <input type="text" name="namalengkap" placeholder="Masukan Nama Lengkap">
        @error('namalengkap')
        <p>
            {{ $message }}
        </p>
        @enderror
        
        <p>Username</p>
        <input type="text" name="username" value="" placeholder="Masukan Username">
        @error('username')
        <p>
            {{ $message }}
        </p>
        @enderror

        <p>Email</p>
        <input type="email" name="email" value="" placeholder="Masukan Email">
        @error('email')
        <p>
            {{ $message }}
        </p>
        @enderror

        <p>Alamat</p>
        <textarea name="alamat" cols="30" rows="10" placeholder="Masukan Alamat"></textarea>
        @error('alamat')
        <p>
            {{ $message }}
        </p>
        @enderror

        <p>Password</p>
        <input type="password" name="password" value="" placeholder="Masukan Password">
        @error('password')
        <p>
            {{ $message }}
        </p>
        @enderror

        <p>Konfirmasi Password</p>
        <input type="password" name="password_confirmation" placeholder="Masukan Konfirmasi Password">
    
        <input type="submit">
    </form>
</body>
</html>