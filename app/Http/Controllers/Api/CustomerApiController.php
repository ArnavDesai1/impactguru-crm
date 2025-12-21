<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\JsonResponse;

class CustomerApiController extends Controller
{
    public function index(): JsonResponse
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer);
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('customers', 'public');
            $data['profile_image'] = $path;
        }

        $customer = Customer::create($data);

        return response()->json($customer, 201);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($customer->profile_image && \Storage::disk('public')->exists($customer->profile_image)) {
                \Storage::disk('public')->delete($customer->profile_image);
            }
            $path = $request->file('profile_image')->store('customers', 'public');
            $data['profile_image'] = $path;
        }

        $customer->update($data);

        return response()->json($customer);
    }

    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
