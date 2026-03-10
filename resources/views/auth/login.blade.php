<!DOCTYPE html>
<html lang="en">
<head>
    <title>register</title>
</head>

<body>
    <h4>Login</h4>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <p>Email</p>
        <input type="email" name="email" value="" placeholder="Masukan Email">
        @error('email')
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

        <input type="submit">
        <p>Belum punya akun? klik <a href="/register">Disini</a></p>
    </form>
</body>
</html>