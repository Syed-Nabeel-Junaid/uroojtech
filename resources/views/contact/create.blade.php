<x-layout title="Contact Us">
    <div class="mx-auto max-w-4xl">
        <h1 class="mb-2 text-3xl font-semibold text-slate-900">Contact Us</h1>
        <p class="mb-10 text-sm text-slate-600">
            Have a question about a product or an order? Send us a message and we'll get back
            to you.
        </p>

        <div class="grid gap-10 md:grid-cols-[1fr_320px]">
            <div>
                @session('status')
                    <div class="mb-6 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
                @endsession

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                    @csrf

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                   class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                   class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="mb-1 block text-sm font-medium text-slate-700">Subject</label>
                        <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="mb-1 block text-sm font-medium text-slate-700">Message</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="rounded-md bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-700">
                        Send Message
                    </button>
                </form>
            </div>

            <aside class="h-fit space-y-4 rounded-lg border border-slate-200 bg-white p-6 text-sm">
                <div>
                    <p class="font-medium text-slate-900">Email</p>
                    <p class="text-slate-600">{{ config('business.email') }}</p>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Phone</p>
                    <p class="text-slate-600">{{ config('business.phone') }}</p>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Address</p>
                    <p class="text-slate-600">{{ config('business.address') }}</p>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Business Hours</p>
                    <p class="text-slate-600">{{ config('business.hours') }}</p>
                </div>
            </aside>
        </div>
    </div>
</x-layout>
