@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="top"><h2>Dashboard</h2></div>

    <div class="stats">
        <div class="card stat"><span>Revenue</span><strong>${{ number_format($revenue, 2) }}</strong></div>
        <div class="card stat"><span>Orders</span><strong>{{ $orderCount }}</strong></div>
        <div class="card stat"><span>New orders</span><strong>{{ $newCount }}</strong></div>
        <div class="card stat"><span>Products</span><strong>{{ $productCount }}</strong></div>
    </div>

    <div class="two">
        <section class="card">
            <h3>Orders by status</h3>
            <div class="bars">
                @foreach (['new', 'confirmed', 'delivered', 'cancelled'] as $s)
                    @php
                        $n = $byStatus[$s] ?? 0;
                        $pct = $orderCount > 0 ? ($n / $orderCount) * 100 : 0;
                    @endphp
                    <div class="bar">
                        <span>{{ $s }}</span>
                        <div><i class="st-{{ $s }}" style="--w: {{ $pct }}%"></i></div>
                        <b>{{ $n }}</b>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="card">
            <h3>Recent orders</h3>
            @forelse ($recent as $o)
                <div class="line">
                    <span>#{{ $o->id }} · {{ $o->items_count }} item(s)</span>
                    <span>${{ number_format($o->total, 2) }}</span>
                </div>
            @empty
                <p>No orders yet. Orders appear here when a customer presses "Place order" in the shop.</p>
            @endforelse
        </section>
    </div>
@endsection