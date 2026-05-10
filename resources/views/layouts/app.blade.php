@php
    use App\Models\Trainer;

    $loggedInTrainer = null;

    if (auth()->check() && auth()->user()->role === 'trainer') {
        $loggedInTrainer = Trainer::where('user_id', auth()->id())->first();
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GymPro') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <style>
        .ts-wrapper.single .ts-control {
            height: 48px;
            /* same as normal input */
            border-radius: 0.75rem;
            border: 1px solid rgb(209 213 219);
            padding: 0 0.75rem;
            display: flex;
            align-items: center;
            box-shadow: none;
        }

        .ts-wrapper.single .ts-control input,
        .ts-wrapper.single .item {
            font-size: 0.95rem;
            /* normal text size */
            line-height: 1.25rem;
            margin: 0;
            padding: 0;
        }

        .ts-wrapper.single .ts-control>div {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .ts-wrapper.focus .ts-control {
            border-color: rgb(59 130 246) !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15) !important;
        }

        .ts-dropdown .option {
            padding: 10px 14px;
            font-size: 0.95rem;
        }
    </style>
    </style>
</head>

<body class="bg-slate-100 text-slate-900">

    <!-- SIDEBAR -->
    <aside class="fixed top-0 left-0 h-screen w-72 bg-slate-950 text-white flex flex-col shadow-2xl z-50">

        <!-- LOGO -->
        <div class="px-6 py-6 border-b border-white/10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow">
                <i data-lucide="dumbbell" class="w-5 h-5"></i>
            </div>
            <h1 class="text-xl font-bold">GymPro</h1>
        </div>

        <!-- USER -->
        <div class="px-4 py-5">
            <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                <div class="flex items-center gap-3">
                    @if(auth()->user()->role === 'trainer' && $loggedInTrainer && $loggedInTrainer->photo)
                        <img src="{{ asset('storage/' . $loggedInTrainer->photo) }}" alt="{{ auth()->user()->name }}"
                            class="w-10 h-10 rounded-full object-cover border border-white/10">
                    @else
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center font-bold">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <p class="text-sm font-semibold">
                            {{ Auth::user()->name ?? 'User' }}
                        </p>
                        <p class="text-xs text-slate-400 capitalize">
                            {{ Auth::user()->role }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-3 space-y-2 overflow-y-auto pb-4">

            {{-- ADMIN / STAFF / MEMBER MAIN --}}
            @if(auth()->user()->role !== 'trainer')
                <p class="text-xs text-slate-500 px-3 mt-2">MAIN</p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>
            @endif

            {{-- ADMIN / STAFF --}}
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-500 px-3 pt-4 pb-1">
                    Management
                </p>

                <a href="{{ route('members.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('members.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Members</span>
                </a>

                <a href="{{ route('trainers.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('trainers.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="user-square-2" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Trainers</span>
                </a>

                <a href="{{ route('payments.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('payments.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Payments</span>
                </a>

                <a href="{{ route('plans.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('plans.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Membership Plans</span>
                </a>

                <a href="{{ route('attendance.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('attendance.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="calendar-check" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Attendance</span>
                </a>

                <a href="{{ route('trainer-assignments.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('trainer-assignments.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="user-cog" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Trainer Assignments</span>
                </a>
            @endif

            {{-- MEMBER --}}
            @if(auth()->user()->role === 'member')
                <p class="text-xs text-slate-500 px-3 mt-4">MY ACCOUNT</p>

                <a href="{{ route('member.profile') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('member.profile') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10' }}">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    <span>My Profile</span>
                </a>

                <a href="{{ route('member.payments') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('member.payments') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10' }}">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                    <span>My Payments</span>
                </a>

                <a href="{{ route('member.attendance') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('member.attendance') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10' }}">
                    <i data-lucide="calendar-check-2" class="w-5 h-5"></i>
                    <span>My Attendance</span>
                </a>
            @endif
            {{-- TRAINER --}}
            @if(auth()->user()->role === 'trainer')
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-500 px-3 pt-4 pb-1">
                    Trainer Panel
                </p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="{{ route('trainer.members') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('trainer.members') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">My Members</span>
                </a>

                <a href="{{ route('trainer.attendance') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('trainer.attendance') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="calendar-check" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Attendance Records</span>
                </a>

                <a href="{{ route('trainer.profile') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('trainer.profile') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="user-circle" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">My Profile Info</span>
                </a>
            @endif

            <!-- LOGOUT -->
            <div class="p-4 border-t border-white/10 mt-4">
                <button type="button" onclick="openLogoutModal()"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-red-500/20 transition">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span>Logout</span>
                </button>
            </div>
        </nav>
    </aside>

    <!-- HEADER -->
    <header class="fixed top-0 left-72 right-0 h-20 bg-white border-b px-6 flex items-center justify-between z-40">
        <h2 class="text-2xl font-bold text-slate-800">
            @yield('title', 'Dashboard')
        </h2>

        <div class="flex items-center gap-3">
            @if(auth()->user()->role === 'trainer' && $loggedInTrainer && $loggedInTrainer->photo)
                <img src="{{ asset('storage/' . $loggedInTrainer->photo) }}" alt="{{ auth()->user()->name }}"
                    class="w-9 h-9 rounded-full object-cover border border-slate-200">
            @else
                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
            @endif

            <span class="text-sm font-semibold">
                {{ Auth::user()->name ?? 'User' }}
            </span>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="ml-72 pt-28 px-6 pb-6 min-h-screen">
        @yield('content')
    </main>

    <!-- LOGOUT MODAL -->
    <div id="logoutModal"
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm hidden items-center justify-center z-[100] px-4">
        <div class="w-full max-w-md rounded-3xl bg-white shadow-2xl border border-slate-200 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <i data-lucide="log-out" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Confirm Logout</h3>
                        <p class="text-sm text-slate-500 mt-1">
                            Are you sure you want to log out of your account?
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeLogoutModal()"
                        class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition font-medium">
                        Cancel
                    </button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition font-medium shadow-sm">
                            Yes, Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        lucide.createIcons();

        function openLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeLogoutModal();
            }
        });

        const logoutModal = document.getElementById('logoutModal');

        if (logoutModal) {
            logoutModal.addEventListener('click', function (event) {
                if (event.target === this) {
                    closeLogoutModal();
                }
            });
        }
    </script>

    @stack('scripts')
</body>

</html>