<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', ['products' => Product::orderBy('id')->get()]);
    }

    public function create(): View
    {
        return view('admin.products.form', [
            'product' => new Product(['section' => 'shop', 'cat' => 'keyboard']),
            'categories' => $this->categories(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Product::create($this->payload($request));

        return redirect()->route('admin.products.index')->with('ok', 'Product added.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', ['product' => $product, 'categories' => $this->categories()]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($this->payload($request));

        return redirect()->route('admin.products.index')->with('ok', 'Product saved.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('ok', 'Product deleted.');
    }

    private function categories()
    {
        return Product::distinct()->orderBy('cat')->pluck('cat');
    }

    private function payload(Request $request): array
    {
        $d = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'cat' => ['required', 'string', 'max:50'],
            'section' => ['required', 'in:shop,collection'],
            'price' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'note' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'specs_text' => ['nullable', 'string', 'max:4000'],
            'img' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:3072'], // 3 MB
        ]);

        // an uploaded picture wins over the typed path
        $img = $d['img'] ?? '';
        if ($request->hasFile('image')) {
            $img = '/storage/' . $request->file('image')->store('products', 'public');
        }

        $specs = array_values(array_filter(array_map('trim', preg_split('/\R/', $d['specs_text'] ?? '') ?: [])));

        return [
            'name' => trim($d['name']),
            'cat' => strtolower(trim($d['cat'])),
            'section' => $d['section'],
            'price' => $d['price'],
            'note' => $d['note'] ?? '',
            'description' => $d['description'] ?? '',
            'specs' => array_slice($specs, 0, 20),
            'img' => $img,
        ];
    }
}