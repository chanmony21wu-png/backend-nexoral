@extends('admin.layout')

@section('title', $product->exists ? 'Edit product' : 'Add product')

@section('content')
    <div class="top">
        <h2>{{ $product->exists ? 'Edit product' : 'Add product' }}</h2>
        <a class="btn ghost small" href="{{ route('admin.products.index') }}">Back</a>
    </div>

    <form class="card form" method="post" enctype="multipart/form-data"
          action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
        @csrf
        @if ($product->exists)
            @method('PUT')
        @endif

        <div class="grid">
            <label class="field">
                <span>Name</span>
                <input name="name" value="{{ old('name', $product->name) }}" required>
            </label>

            <label class="field">
                <span>Category</span>
                <input name="cat" list="cats" value="{{ old('cat', $product->cat) }}" required>
                <datalist id="cats">
                    @foreach ($categories as $c)
                        <option value="{{ $c }}">
                    @endforeach
                </datalist>
            </label>

            <label class="field">
                <span>Price ($)</span>
                <input name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price) }}" required>
            </label>

            <label class="field">
                <span>Where to show it</span>
                <select name="section">
                    <option value="shop" @selected(old('section', $product->section) === 'shop')>Shop all gear</option>
                    <option value="collection" @selected(old('section', $product->section) === 'collection')>Collection</option>
                </select>
            </label>

            <label class="field wide">
                <span>Short note</span>
                <input name="note" value="{{ old('note', $product->note) }}">
            </label>

            <label class="field wide">
                <span>Description</span>
                <textarea name="description" rows="3">{{ old('description', $product->description) }}</textarea>
            </label>

            <label class="field wide">
                <span>Specs (one per line)</span>
                <textarea name="specs_text" rows="4">{{ old('specs_text', implode("\n", $product->specs ?? [])) }}</textarea>
            </label>

            <div class="field wide">
                <span>Picture</span>
                <div class="img-row">
                    @if ($product->img)
                        <img class="thumb big" src="{{ $product->previewUrl() }}" alt="">
                    @endif
                    <input name="img" placeholder="/images/1.png" value="{{ old('img', $product->img) }}">
                    <label class="btn ghost small upload">
                        Upload a picture
                        <input type="file" name="image" accept="image/*" hidden>
                    </label>
                </div>
                <small class="hint">Type a path like /images/1.png (a picture in your React project), or upload a file. An uploaded file replaces the path.</small>
            </div>
        </div>

        <div class="form-foot">
            <a class="btn ghost" href="{{ route('admin.products.index') }}">Cancel</a>
            <button class="btn" type="submit">Save product</button>
        </div>
    </form>
@endsection