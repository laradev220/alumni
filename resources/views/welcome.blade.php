<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AlumniConnect') }} — Reconnect, Engage, Thrive</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                <span class="text-xl font-bold text-gray-900">AlumniConnect</span>
            </div>
            <nav class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Get Started
                            </a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <main>
        <section class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight">
                        Reconnect with Your <span class="text-indigo-600">Alma Mater</span>
                    </h1>
                    <p class="mt-6 text-lg sm:text-xl text-gray-600 leading-relaxed">
                        Network with alumni, attend events, find mentors and jobs, 
                        and support your university through transparent fundraising.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                        @guest
                            <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Join AlumniConnect
                            </a>
                            <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 border border-gray-300 rounded-lg font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Sign In
                            </a>
                        @endguest
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white shadow-md hover:bg-indigo-700 transition">
                                Go to Dashboard
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900">Everything You Need</h2>
                    <p class="mt-4 text-lg text-gray-600">Built for alumni, students, and university communities.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Alumni Directory</h3>
                        <p class="text-gray-600 text-sm">Search and connect with alumni by year, department, or city. Find old classmates and build your network.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Events & Reunions</h3>
                        <p class="text-gray-600 text-sm">Create and attend events — virtual or in-person. RSVP with live count and stay updated.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Job Board</h3>
                        <p class="text-gray-600 text-sm">Post and find job opportunities, internships, and career connections within the alumni network.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Fundraising</h3>
                        <p class="text-gray-600 text-sm">Support university causes with transparent donations. Track progress with live updates and proof uploads.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Mentorship</h3>
                        <p class="text-gray-600 text-sm">Alumni mentor current students. Request guidance, set expertise areas, and give back.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Real-time Updates</h3>
                        <p class="text-gray-600 text-sm">Instant notifications for RSVPs, donations, and messages via Laravel Reverb.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-indigo-600 rounded-2xl p-12 lg:p-16">
                    <h2 class="text-3xl font-bold text-white mb-4">Ready to Reconnect?</h2>
                    <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">
                        Join your university's alumni network. It's free, secure, and built for your community.
                    </p>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3.5 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition shadow-md">
                            Create Your Account
                        </a>
                    @endguest
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-3.5 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition shadow-md">
                            Go to Dashboard
                        </a>
                    @endauth
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'AlumniConnect') }}. Built with Laravel & Livewire.</p>
        </div>
    </footer>
</body>
</html>
