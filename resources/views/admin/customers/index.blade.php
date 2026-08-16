<x-admin-layout title="Customers">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-600">{{ $customers->total() }} customers</p>

        <form method="GET" action="{{ route('admin.customers.index') }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..."
                   class="w-64 rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        </form>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Registered</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($customers as $customer)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $customer->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $customer->email }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $customer->phone ?? '—' }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $customer->created_at->format('M j, Y') }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.customers.show', $customer) }}" class="text-slate-600 hover:text-slate-900">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-sm text-slate-500">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $customers->links() }}</div>
</x-admin-layout>
