<x-admin-layout title="Customer Details">
    <a href="{{ route('admin.customers.index') }}" class="mb-6 inline-block text-sm text-slate-600 hover:text-slate-900">
        &larr; Back to Customers
    </a>

    <div class="max-w-xl rounded-lg border border-slate-200 bg-white p-6">
        <dl class="space-y-4 text-sm">
            <div class="flex justify-between border-b border-slate-100 pb-3">
                <dt class="text-slate-500">Name</dt>
                <dd class="font-medium text-slate-900">{{ $customer->name }}</dd>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-3">
                <dt class="text-slate-500">Email</dt>
                <dd class="font-medium text-slate-900">{{ $customer->email }}</dd>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-3">
                <dt class="text-slate-500">Phone</dt>
                <dd class="font-medium text-slate-900">{{ $customer->phone ?? 'Not provided' }}</dd>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-3">
                <dt class="text-slate-500">Account Status</dt>
                <dd>
                    <span class="rounded-full px-2 py-1 text-xs font-medium {{ $customer->email_verified_at ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $customer->email_verified_at ? 'Verified' : 'Unverified' }}
                    </span>
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-slate-500">Registered</dt>
                <dd class="font-medium text-slate-900">{{ $customer->created_at->format('M j, Y \a\t g:i A') }}</dd>
            </div>
        </dl>
    </div>
</x-admin-layout>
