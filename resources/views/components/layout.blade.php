<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? "{$title} — " . config('app.name') : config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? 'Shop laptops, smartphones, and technology accessories at ' . config('app.name') . '.' }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/branding/logo.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    @php
        $navLinks = [
            ['url' => url('/'), 'label' => 'Home', 'active' => request()->routeIs('home')],
            ['url' => route('shop.index'), 'label' => 'Shop', 'active' => request()->routeIs('shop.*')],
            ['url' => route('about'), 'label' => 'About', 'active' => request()->routeIs('about')],
            ['url' => route('contact'), 'label' => 'Contact', 'active' => request()->routeIs('contact*')],
        ];
    @endphp

    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/80">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <img src="{{ asset('images/branding/logo.jpg') }}" alt="{{ config('app.name') }}"
                     width="48" height="48"
                     class="h-12 w-12 max-h-12 shrink-0 rounded-full object-contain">
                <span class="text-lg font-semibold tracking-tight text-slate-900">{{ config('app.name') }}</span>
            </a>

            {{-- Desktop navigation --}}
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 sm:flex" aria-label="Primary">
                @foreach ($navLinks as $link)
                    <a href="{{ $link['url'] }}"
                       class="hover:text-slate-900 {{ $link['active'] ? 'font-semibold text-slate-900' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach

                <a href="{{ route('cart.index') }}" class="hover:text-slate-900 {{ request()->routeIs('cart.*') ? 'font-semibold text-slate-900' : '' }}">
                    Cart
                    @if (($cartCount ?? 0) > 0)
                        <span class="ml-1 rounded-full bg-slate-900 px-1.5 py-0.5 text-xs font-semibold text-white">{{ $cartCount }}</span>
                    @endif
                </a>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-900">Admin Dashboard</a>
                    @else
                        <a href="{{ route('account.dashboard') }}" class="hover:text-slate-900 {{ request()->routeIs('account.*') ? 'font-semibold text-slate-900' : '' }}">Account</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-slate-900">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-slate-900">Login</a>
                    <a href="{{ route('register') }}"
                       class="rounded-md bg-slate-900 px-3 py-1.5 text-white hover:bg-slate-700">Register</a>
                @endauth
            </nav>

            {{-- Mobile navigation: cart badge always visible, plus a menu disclosure (no JS needed) --}}
            <div class="flex items-center gap-3 sm:hidden">
                <a href="{{ route('cart.index') }}" aria-label="Cart" class="relative text-slate-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.755-4.807 1.972-7.216a1.125 1.125 0 00-1.243-1.234H5.106M7.5 14.25L5.106 5.021M6 18.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    @if (($cartCount ?? 0) > 0)
                        <span class="absolute -right-2 -top-2 rounded-full bg-slate-900 px-1.5 py-0.5 text-xs font-semibold text-white">{{ $cartCount }}</span>
                    @endif
                </a>

                <details class="group relative list-none">
                    <summary class="flex cursor-pointer list-none items-center rounded-md p-1 text-slate-700 [&::-webkit-details-marker]:hidden" aria-label="Open menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                        </svg>
                    </summary>

                    <nav aria-label="Primary"
                         class="absolute right-0 top-full z-10 mt-2 w-56 rounded-lg border border-slate-200 bg-white p-2 text-sm font-medium text-slate-600 shadow-lg">
                        @foreach ($navLinks as $link)
                            <a href="{{ $link['url'] }}"
                               class="block rounded-md px-3 py-2 hover:bg-slate-50 hover:text-slate-900 {{ $link['active'] ? 'font-semibold text-slate-900' : '' }}">
                                {{ $link['label'] }}
                            </a>
                        @endforeach

                        <div class="my-2 border-t border-slate-100"></div>

                        @auth
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block rounded-md px-3 py-2 hover:bg-slate-50 hover:text-slate-900">Admin Dashboard</a>
                            @else
                                <a href="{{ route('account.dashboard') }}" class="block rounded-md px-3 py-2 hover:bg-slate-50 hover:text-slate-900">Account</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full rounded-md px-3 py-2 text-left hover:bg-slate-50 hover:text-slate-900">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 hover:bg-slate-50 hover:text-slate-900">Login</a>
                            <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 hover:bg-slate-50 hover:text-slate-900">Register</a>
                        @endauth
                    </nav>
                </details>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-10">
        {{ $slot }}
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-6 py-10">
            <div class="grid gap-8 sm:grid-cols-3">
                <div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/branding/logo.jpg') }}" alt="{{ config('business.name') }}" class="h-8 w-8 rounded-full">
                        <p class="text-sm font-semibold text-slate-900">{{ config('business.name') }}</p>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">{{ config('business.address') }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-900">Contact</p>
                    <p class="mt-2 text-sm text-slate-500">{{ config('business.email') }}</p>
                    <p class="text-sm text-slate-500">{{ config('business.phone') }}</p>
                    <p class="text-sm text-slate-500">{{ config('business.hours') }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-900">Company</p>
                    <ul class="mt-2 space-y-1 text-sm text-slate-500">
                        <li><a href="{{ route('about') }}" class="hover:text-slate-900">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-slate-900">Contact Us</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-slate-900">FAQ</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-slate-900">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-slate-900">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('return-policy') }}" class="hover:text-slate-900">Return Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 border-t border-slate-100 pt-6 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} {{ config('business.name') }}. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
