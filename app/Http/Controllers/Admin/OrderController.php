<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('admin.orders.index', ['orders' => Order::with('items')->latest('id')->limit(200)->get()]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['new', 'confirmed', 'delivered', 'cancelled'])],
        ]);

        $order->update($data);

        return back()->with('ok', "Order #{$order->id} is now {$order->status}.");
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return back()->with('ok', 'Order deleted.');
    }
}