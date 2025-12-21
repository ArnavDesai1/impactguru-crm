<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');

        // Filter by status
        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('status', $request->input('status'));
        }

        $orders = $query->latest()->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    public function store(StoreOrderRequest $request)
    {
        Order::create([
            'customer_id' => $request->customer_id,
            'order_number' => 'ORD-' . strtoupper(Str::random(6)),
            'amount' => $request->amount,
            'status' => $request->status,
            'order_date' => $request->order_date,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        $order->load('customer');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        return view('orders.edit', compact('order', 'customers'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        
        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted');
    }
}
