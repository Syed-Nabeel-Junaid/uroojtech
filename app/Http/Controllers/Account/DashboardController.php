<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the customer account dashboard.
     */
    public function index(Request $request): View
    {
        return view('account.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
