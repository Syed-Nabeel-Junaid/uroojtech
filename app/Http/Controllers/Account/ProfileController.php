<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ProfileUpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the profile edit form.
     */
    public function edit(Request $request): View
    {
        return view('account.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the customer's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated())->save();

        return redirect()->route('account.profile.edit')->with('status', 'profile-updated');
    }
}
