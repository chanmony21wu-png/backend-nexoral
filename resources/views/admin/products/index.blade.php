@extends('admin.layout')

@section('title', 'Products')

@section('content')
    <div class="top">
        <h2>Products</h2>
        <a class="btn small" href="{{ route('admin.products.create') }}">+ Add product</a>
    </div>

    <div class="card scroll">
        <table class="table">
            <thead>
                <tr><th></th><th>Name</th><th>Category</th><th>Shown in</th><th>Price</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($products as $p)
                    <tr>
                        <td>
                            @if ($p->img)
                                <img class="thumb" src="{{ $p->previewUrl() }}" alt="">
                            @else
                                <div class="thumb"></div>
                            @endif
                        </td>
                        <td>{{ $p->name }}<small>{{ $p->note }}</small></td>
                        <td><span class="pill">{{ $p->cat }}</span></td>
                        <td>{{ $p->section === 'collection' ? 'Collection' : 'Shop' }}</td>
                        <td>${{ number_format($p->price, 2) }}</td>
                        <td class="actions">
                            <a class="chip" href="{{ route('admin.products.edit', $p) }}">Edit</a>
                            <form method="post" action="{{ route('admin.products.destroy', $p) }}" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="chip danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">No products. Click "+ Add product".</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection