<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportCustomersCsv()
    {
        $customers = Customer::all();
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=customers.csv"
        );

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Address', 'Created At']);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->name,
                    $customer->email,
                    $customer->phone,
                    $customer->address,
                    $customer->created_at->format('Y-m-d H:i:s')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportOrdersCsv()
    {
        $orders = Order::with('customer')->get();
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv"
        );

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Order Number', 'Customer', 'Amount', 'Status', 'Order Date', 'Created At']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->customer->name,
                    $order->amount,
                    $order->status,
                    $order->order_date->format('Y-m-d'),
                    $order->created_at->format('Y-m-d H:i:s')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportCustomersPdf()
    {
        $customers = Customer::all();
        $html = view('exports.customers-pdf', compact('customers'))->render();
        
        return response($html)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="customers.pdf"');
    }

    public function exportOrdersPdf()
    {
        $orders = Order::with('customer')->get();
        $html = view('exports.orders-pdf', compact('orders'))->render();
        
        return response($html)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="orders.pdf"');
    }
}
