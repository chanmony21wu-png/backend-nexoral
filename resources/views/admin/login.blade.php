<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login · Nexora</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="login-wrap">
    <form class="card login" method="post" action="{{ url('/admin/login') }}">
        @csrf
        <span class="logo">Nexora</span>
        <h2>Admin login</h2>
        <p>Log in to manage your shop.</p>

        <input type="email" name="email" placeholder="Email" value="{{ old('email', 'admin@nexora.test') }}" required>
        <input type="password" name="password" placeholder="Password" required autofocus>

        @error('email')
            <small class="error">{{ $message }}</small>
        @enderror

        <label class="remember"><input type="checkbox" name="remember" value="1"> Keep me logged in</label>
        <button class="btn" type="submit">Log in</button>
    </form>
</div>
</body>
</html>