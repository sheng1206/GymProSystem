<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro – Manage Your Gym Smarter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        .font-bebas {
            font-family: 'Bebas Neue', cursive;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-inter">
    <div class="relative min-h-screen flex flex-col overflow-hidden">

        <!-- Background image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1600"
                class="w-full h-full object-cover" alt="Gym">
            <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/60 to-blue-950/80"></div>
        </div>

        <!-- Navbar -->
        <nav class="relative z-20 flex items-center justify-between px-8 py-6">
            <div class="flex items-center gap-2">
                <div
                    class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    G
                </div>
                <span class="text-white font-semibold text-lg tracking-wide">GymPro</span>
            </div>


            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 text-sm text-white border border-white/30 rounded-lg hover:bg-white/10 transition">
                        Login
                    </a>

                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 text-sm text-white border border-white/30 rounded-lg hover:bg-white/10 transition">
                        Login
                    </a>

                @endauth
            </div>

        </nav>

        <!-- Hero -->
        <div class="relative z-20 flex-1 flex items-center justify-center px-6 py-20">
            <div class="max-w-4xl mx-auto text-center">

                <!-- Badge -->
                <div
                    class="inline-flex items-center gap-2 bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-medium px-4 py-2 rounded-full mb-8 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
                    Gym Management Platform
                </div>

                <!-- Headline -->
                <h1 class="font-bebas text-7xl md:text-9xl text-white leading-none mb-6 tracking-wide">
                    Manage Your <br>
                    <span class="text-blue-400">Gym Smarter</span>
                </h1>

                <!-- Subtext -->
                <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-12 leading-relaxed font-light">
                    Track members, trainers, payments, and attendance —
                    all in one powerful platform built for modern gyms.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">

                    <!-- Primary Button -->
                    <a href="{{ route('register') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl
                bg-blue-600 hover:bg-blue-700 text-white font-semibold text-lg
               shadow-lg shadow-blue-900/30 hover:shadow-xl hover:-translate-y-0.5
               transition-all duration-300 min-w-[250px]">
                        <span class="text-xl">🚀</span>
                        <span>Get Started Free</span>
                    </a>

                    <!-- Secondary Button -->
                    <a href="{{ route('login') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl
               border border-white/25 bg-white/10 backdrop-blur-md
               text-white font-semibold text-lg
               hover:bg-white/20 hover:border-white/40 hover:-translate-y-0.5
               transition-all duration-300 min-w-[250px]">
                        <span class="text-xl">🏆</span>
                        <span>Login to Dashboard</span>
                    </a>

                </div>

                <!-- Stats -->
                <div class="flex justify-center items-center mt-8 text-white text-center divide-x divide-white/20">

                    <div class="px-8">
                        <h3 class="text-4xl font-extrabold">500+</h3>
                        <p class="text-xs tracking-widest text-white/70 mt-1">MEMBERS</p>
                    </div>

                    <div class="px-8">
                        <h3 class="text-4xl font-extrabold">98%</h3>
                        <p class="text-xs tracking-widest text-white/70 mt-1">SATISFACTION</p>
                    </div>

                    <div class="px-8">
                        <h3 class="text-4xl font-extrabold">24/7</h3>
                        <p class="text-xs tracking-widest text-white/70 mt-1">ACCESS</p>
                    </div>

                </div>

            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 max-w-5xl mx-auto mt-16 text-center text-white">

            <!-- Member Management -->
            <div class="group flex flex-col items-center">
                <div
                    class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center mb-4 group-hover:bg-blue-500/20 group-hover:scale-110 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20a4 4 0 00-8 0m8 0H9m8 0h3m-3-8a4 4 0 10-8 0m8 0a4 4 0 11-8 0m8 0h3m-3 0H9" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold leading-tight">Member Management</h3>
            </div>

            <!-- Payment Tracking -->
            <div class="group flex flex-col items-center">
                <div
                    class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center mb-4 group-hover:bg-green-500/20 group-hover:scale-110 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="6" width="18" height="12" rx="2" ry="2"></rect>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold leading-tight">Payment Tracking</h3>
            </div>

            <!-- Attendance Logs -->
            <div class="group flex flex-col items-center">
                <div
                    class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center mb-4 group-hover:bg-orange-500/20 group-hover:scale-110 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-orange-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18M9 15l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold leading-tight">Attendance Logs</h3>
            </div>

            <!-- Trainer Assignments -->
            <div class="group flex flex-col items-center">
                <div
                    class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center mb-4 group-hover:bg-purple-500/20 group-hover:scale-110 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0ZM12 14c-4 0-7 2-7 4.5V20h14v-1.5C19 16 16 14 12 14Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 8h2m-1-1v2" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold leading-tight">Trainer Assignments</h3>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>

    </div>
</body>

</html>