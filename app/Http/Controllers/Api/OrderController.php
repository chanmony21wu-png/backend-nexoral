<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // a customer presses "Place order" in the React shop
    public function store(Request $request)
    {
        $data = $request->validate([
            'items' => ['required', 'array', 'min:1', 'max:50'],
            'items.*' => ['integer', 'exists:products,id'],
            'customer_name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $ids = array_map('intval', $data['items']);

        // prices always come from the database, never from the browser
        $products = Product::whereIn('id', array_unique($ids))->get()->keyBy('id');

        $order = DB::transaction(function () use ($ids, $products, $data) {
            $total = 0;
            foreach ($ids as $id) {
                $total += $products[$id]->price;
            }

            $order = Order::create([
                'customer_name' => trim($data['customer_name']),
                'phone' => $data['phone'] ?? null,
                'address' => trim($data['address']),
                'note' => $data['note'] ?? null,
                'total' => round($total, 2),
            ]);

            foreach ($ids as $id) {
                $p = $products[$id];
                $order->items()->create(['product_id' => $p->id, 'name' => $p->name, 'price' => $p->price]);
            }

            return $order;
        });

        return response()->json(['id' => $order->id, 'total' => $order->total], 201);
    }
}