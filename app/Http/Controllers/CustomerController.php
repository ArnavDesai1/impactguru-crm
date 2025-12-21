<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search by name or email
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $customers = $query->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        // Handle file upload
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('customers', 'public');
            $data['profile_image'] = $path;
        }

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();

        // Handle file upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($customer->profile_image && \Storage::disk('public')->exists($customer->profile_image)) {
                \Storage::disk('public')->delete($customer->profile_image);
            }
            $path = $request->file('profile_image')->store('customers', 'public');
            $data['profile_image'] = $path;
        }

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
