@extends('admin.layout')

@section('title', 'Orders')

@section('content')
    <div class="top"><h2>Orders</h2></div>

    <div class="orders">
        @forelse ($orders as $o)
            <article class="card order">
                <div class="order-head">
                    <div>
                        <strong>Order #{{ $o->id }}</strong>
                        <small>{{ $o->created_at->format('d M Y, H:i') }}</small>
                    </div>
                    <form method="post" action="{{ route('admin.orders.update', $o) }}">
                        @csrf
                        @method('PUT')
                        <select name="status" class="status st-{{ $o->status }}" onchange="this.form.submit()">
                            @foreach (['new', 'confirmed', 'delivered', 'cancelled'] as $s)
                                <option value="{{ $s }}" @selected($o->status === $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="customer">
                    <div><span>Name</span> {{ $o->customer_name ?? '-' }}</div>
                    @if ($o->phone)
                        <div><span>Phone</span> {{ $o->phone }}</div>
                    @endif
                    <div>
                        <span>Address</span>
                        @if (str_starts_with($o->address ?? '', 'http'))
                            <a href="{{ $o->address }}" target="_blank" rel="noopener noreferrer">Open the map link</a>
                        @else
                            {{ $o->address ?? '-' }}
                        @endif
                    </div>
                    @if ($o->note)
                        <div><span>Note</span> {{ $o->note }}</div>
                    @endif
                </div>

                @foreach ($o->items as $i)
                    <div class="line"><span>{{ $i->name }}</span><span>${{ number_format($i->price, 2) }}</span></div>
                @endforeach

                <div class="order-foot">
                    <strong>Total ${{ number_format($o->total, 2) }}</strong>
                    <form method="post" action="{{ route('admin.orders.destroy', $o) }}" onsubmit="return confirm('Delete this order?')">
                        @csrf
                        @method('DELETE')
                        <button class="chip danger" type="submit">Delete</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="card"><p>No orders yet.</p></div>
        @endforelse
    </div>
@endsection