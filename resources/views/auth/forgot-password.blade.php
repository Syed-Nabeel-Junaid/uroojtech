<x-layout title="Forgot Password">
    <div class="mx-auto max-w-md">
        <h1 class="mb-2 text-2xl font-semibold">Forgot your password?</h1>
        <p class="mb-6 text-sm text-slate-600">
            Enter your email and we'll send you a link to reset your password.
        </p>

        @session('status')
            <div class="mb-4 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endsession

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700">
                Email Password Reset Link
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-600">
            <a href="{{ route('login') }}" class="font-medium text-slate-900 hover:underline">Back to login</a>
        </p>
    </div>
</x-layout>
