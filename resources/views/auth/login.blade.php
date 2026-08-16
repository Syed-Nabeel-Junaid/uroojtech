<x-layout title="Log In">
    <div class="mx-auto max-w-md">
        <h1 class="mb-6 text-2xl font-semibold">Log in to your account</h1>

        @session('status')
            <div class="mb-4 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300">
                    Remember me
                </label>

                <a href="{{ route('password.request') }}" class="font-medium text-slate-900 hover:underline">
                    Forgot password?
                </a>
            </div>

            <button type="submit"
                    class="w-full rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700">
                Log In
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-slate-900 hover:underline">Register</a>
        </p>
    </div>
</x-layout>
