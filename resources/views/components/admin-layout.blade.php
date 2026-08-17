<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ($title ?? 'Dashboard') . ' — ' . config('app.name') . ' Admin' }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/branding/logo.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    @php
        $adminNavLinks = [
            ['route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'label' => 'Dashboard'],
            ['route' => 'admin.products.index', 'pattern' => 'admin.products.*', 'label' => 'Products'],
            ['route' => 'admin.categories.index', 'pattern' => 'admin.categories.*', 'label' => 'Categories'],
            ['route' => 'admin.customers.index', 'pattern' => 'admin.customers.*', 'label' => 'Customers'],
        ];
    @endphp

    <div class="flex min-h-screen flex-col sm:flex-row">
        {{-- Desktop sidebar --}}
        <aside class="hidden w-60 shrink-0 border-r border-slate-200 bg-white sm:block">
            <div class="flex items-center gap-2.5 border-b border-slate-200 px-6 py-4">
                <img src="{{ asset('images/branding/logo.jpg') }}" alt="{{ config('app.name') }}" class="h-8 w-8 rounded-full">
                <div class="text-lg font-semibold leading-tight">
                    {{ config('app.name') }}
                    <span class="block text-xs font-normal uppercase tracking-wide text-slate-400">Admin</span>
                </div>
            </div>

            <nav class="flex flex-col gap-1 p-4 text-sm font-medium text-slate-600" aria-label="Admin">
                @foreach ($adminNavLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs($link['pattern']) ? 'bg-slate-100 text-slate-900' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- Mobile top bar --}}
        <div class="flex items-center justify-between border-b border-slate-200 bg-white px-4 py-3 sm:hidden">
            <span class="flex items-center gap-2 text-base font-semibold">
                <img src="{{ asset('images/branding/logo.jpg') }}" alt="{{ config('app.name') }}" class="h-7 w-7 rounded-full">
                {{ config('app.name') }} <span class="text-xs font-normal uppercase text-slate-400">Admin</span>
            </span>

            <details class="group relative list-none">
                <summary class="flex cursor-pointer list-none items-center rounded-md p-1 text-slate-700 [&::-webkit-details-marker]:hidden" aria-label="Open admin menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                    </svg>
                </summary>

                <nav aria-label="Admin"
                     class="absolute right-0 top-full z-10 mt-2 w-56 rounded-lg border border-slate-200 bg-white p-2 text-sm font-medium text-slate-600 shadow-lg">
                    @foreach ($adminNavLinks as $link)
                        <a href="{{ route($link['route']) }}"
                           class="block rounded-md px-3 py-2 hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs($link['pattern']) ? 'font-semibold text-slate-900' : '' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    <div class="my-2 border-t border-slate-100"></div>

                    <a href="{{ url('/') }}" class="block rounded-md px-3 py-2 hover:bg-slate-50 hover:text-slate-900">View Site</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full rounded-md px-3 py-2 text-left hover:bg-slate-50 hover:text-slate-900">Logout</button>
                    </form>
                </nav>
            </details>
        </div>

        <div class="min-w-0 flex-1">
            <header class="hidden items-center justify-between border-b border-slate-200 bg-white px-8 py-4 sm:flex">
                <h1 class="text-lg font-semibold">{{ $title ?? 'Dashboard' }}</h1>

                <div class="flex items-center gap-4 text-sm text-slate-600">
                    <span>{{ auth()->user()->name }}</span>
                    <a href="{{ url('/') }}" class="hover:text-slate-900">View Site</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-slate-900">Logout</button>
                    </form>
                </div>
            </header>

            <h1 class="px-4 pt-4 text-lg font-semibold sm:hidden">{{ $title ?? 'Dashboard' }}</h1>

            <main class="overflow-x-auto p-4 sm:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
