<x-layout title="Change Password">
    <div class="mx-auto max-w-lg">
        <h1 class="mb-6 text-2xl font-semibold">Change Password</h1>

        @session('status')
            @if (session('status') === 'password-updated')
                <div class="mb-4 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">
                    Your password has been updated.
                </div>
            @endif
        @endsession

        <form method="POST" action="{{ route('account.password.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="mb-1 block text-sm font-medium text-slate-700">Current Password</label>
                <input id="current_password" name="current_password" type="password" required
                       class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">New Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">Confirm New Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
            </div>

            <button type="submit"
                    class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700">
                Update Password
            </button>
        </form>
    </div>
</x-layout>
