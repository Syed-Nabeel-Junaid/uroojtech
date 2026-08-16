<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request): View
    {
        $customers = User::query()
            ->where('role', 'customer')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.customers.index', ['customers' => $customers]);
    }

    /**
     * Display a single customer's details.
     */
    public function show(User $customer): View
    {
        abort_unless($customer->role === 'customer', 404);

        return view('admin.customers.show', ['customer' => $customer]);
    }
}
