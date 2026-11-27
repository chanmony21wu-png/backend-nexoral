<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') · Nexora</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
@php $newOrders = \App\Models\Order::where('status', 'new')->count(); @endphp
<div class="adm">
    <aside class="side">
        <span class="logo">Nexora</span>
        <small class="tag">Admin</small>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'on' : '' }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'on' : '' }}">Products</a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'on' : '' }}">
                Orders
                @if ($newOrders > 0)<b class="count">{{ $newOrders }}</b>@endif
            </a>
        </nav>
        <div class="side-foot">
            {{-- the address of your React shop while you work on it --}}
            <a class="btn ghost small" href="http://localhost:5173" target="_blank">View shop</a>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="chip" type="submit">Log out</button>
            </form>
        </div>
    </aside>

    <main class="main">
        @if (session('ok'))
            <div class="flash ok">{{ session('ok') }}</div>
        @endif
        @if ($errors->any())
            <div class="flash err">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>