<x-layout title="My Account">
    <h1 class="mb-6 text-2xl font-semibold">My Account</h1>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="rounded-lg border border-slate-200 bg-white p-6 md:col-span-2">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Account Information</h2>

            <dl class="space-y-3 text-sm">
                <div class="flex justify-between border-b border-slate-100 pb-3">
                    <dt class="text-slate-500">Name</dt>
                    <dd class="font-medium text-slate-900">{{ $user->name }}</dd>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-3">
                    <dt class="text-slate-500">Email</dt>
                    <dd class="font-medium text-slate-900">{{ $user->email }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-500">Phone</dt>
                    <dd class="font-medium text-slate-900">{{ $user->phone ?? 'Not provided' }}</dd>
                </div>
            </dl>
        </div>

        <div class="space-y-3">
            <a href="{{ route('account.profile.edit') }}"
               class="block rounded-lg border border-slate-200 bg-white p-4 text-sm font-medium text-slate-900 hover:border-slate-300">
                Edit Profile
            </a>
            <a href="{{ route('account.password.edit') }}"
               class="block rounded-lg border border-slate-200 bg-white p-4 text-sm font-medium text-slate-900 hover:border-slate-300">
                Change Password
            </a>
        </div>
    </div>
</x-layout>
