@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-[#0a1024] flex items-center justify-center px-4 py-6">

        <div
            class="w-full max-w-5xl min-h-[600px] rounded-3xl overflow-hidden border border-white/10 shadow-2xl grid grid-cols-1 md:grid-cols-2">

            <!-- LEFT SIDE -->
            <div class="bg-white/10 backdrop-blur-md px-8 py-8 flex flex-col justify-center">

                <h1 class="text-white text-3xl font-bold leading-tight tracking-tight">
                    Welcome back to <br>
                    <span class="text-cyan-400">GymPro</span>
                </h1>

                <p class="mt-4 text-slate-300 text-sm leading-6">
                    Manage your gym smarter with a clean and modern system.
                </p>

                <div class="mt-6 space-y-2">
                    <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                        <h3 class="text-white text-sm font-medium">Admin</h3>
                        <p class="text-slate-400 text-xs">Manage users, plans, payments, and attendance.</p>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                        <h3 class="text-white text-sm font-medium">Staff</h3>
                        <p class="text-slate-400 text-xs">Register members and record payments.</p>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                        <h3 class="text-white text-sm font-medium">Trainer</h3>
                        <p class="text-slate-400 text-xs">Assign and monitor member progress.</p>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                        <h3 class="text-white text-sm font-medium">Member</h3>
                        <p class="text-slate-400 text-xs">View profile, plans, and records.</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="bg-[#111c3d] px-8 py-8 flex items-center">
                <div class="w-full">

                    <h2 class="text-white text-xl font-semibold">Log in</h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Enter your account details to continue.
                    </p>

                    <!-- NOTE -->
                    <div class="mt-4 bg-cyan-500/10 border border-cyan-400/20 text-cyan-100 p-3 rounded-lg text-xs">
                        New here? Create a member account first, then log in.
                    </div>

                    <!-- ERRORS -->
                    @if ($errors->any())
                        <div class="mt-3 bg-red-500/20 border border-red-400 text-red-200 p-3 rounded-lg text-xs">
                            @foreach ($errors->all() as $error)
                                <p>• {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- FORM -->
                    <form method="POST" action="{{ route('login') }}" class="mt-5 space-y-4">
                        @csrf

                        <!-- EMAIL -->
                        <div>
                            <label class="text-slate-300 text-xs mb-1 block">Email</label>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full h-10 rounded-lg bg-[#18264d] border border-white/10 text-white px-3 text-sm focus:ring-2 focus:ring-cyan-400 outline-none"
                                placeholder="Enter your email">
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="text-slate-300 text-xs mb-1 block">Password</label>
                            <input type="password" name="password" required
                                class="w-full h-10 rounded-lg bg-[#18264d] border border-white/10 text-white px-3 text-sm focus:ring-2 focus:ring-cyan-400 outline-none"
                                placeholder="Enter your password">
                        </div>

                        <!-- REMEMBER + FORGOT -->
                        <div class="flex justify-between items-center text-xs">

                            <label class="text-slate-400 flex items-center gap-2">
                                <input type="checkbox" name="remember" class="rounded border-white/20 bg-[#18264d]">
                                Remember me
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-cyan-400 hover:text-cyan-300 transition">
                                    Forgot password?
                                </a>
                            @endif

                        </div>

                        <!-- LOGIN BUTTON -->
                        <button type="submit"
                            class="w-full h-10 bg-cyan-400 hover:bg-cyan-300 text-[#0a1024] font-medium rounded-lg transition text-sm">
                            Log in
                        </button>

                    </form>

                    <!-- REGISTER -->
                    <p class="mt-4 text-center text-xs text-slate-400">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 transition">
                            Register here
                        </a>
                    </p>

                </div>
            </div>

        </div>

    </div>
@endsection