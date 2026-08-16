<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdatePasswordRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Display the password change form.
     */
    public function edit(Request $request): View
    {
        return view('account.password');
    }

    /**
     * Update the customer's password.
     */
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => Hash::make($request->string('password')),
        ]);

        return redirect()->route('account.password.edit')->with('status', 'password-updated');
    }
}
