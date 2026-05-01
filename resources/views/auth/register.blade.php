@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-[#0a1024] flex items-center justify-center px-4 py-6">
        <div
            class="w-full max-w-5xl min-h-[600px] rounded-3xl overflow-hidden border border-white/10 shadow-2xl grid grid-cols-1 md:grid-cols-2">

            <!-- LEFT SIDE -->
            <div class="bg-white/10 backdrop-blur-md px-8 py-8 flex flex-col justify-center">
                <h1 class="text-white text-3xl font-bold leading-tight tracking-tight">
                    Create your <br>
                    <span class="text-cyan-400">GymPro</span> account
                </h1>

                <p class="mt-4 text-slate-300 text-sm leading-6">
                    Register as a member to access your profile, plans, payments, and attendance.
                </p>

                <div class="mt-6 space-y-2">
                    <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                        <h3 class="text-white text-sm font-medium">Member Access</h3>
                        <p class="text-slate-400 text-xs">View your profile and gym records anytime.</p>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                        <h3 class="text-white text-sm font-medium">Payments</h3>
                        <p class="text-slate-400 text-xs">Track your membership and payment history.</p>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                        <h3 class="text-white text-sm font-medium">Attendance</h3>
                        <p class="text-slate-400 text-xs">See your attendance records in one place.</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="bg-[#111c3d] px-8 py-8 flex items-center">
                <div class="w-full">
                    <h2 class="text-white text-xl font-semibold">Create account</h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Fill in your details to register as a member.
                    </p>

                    @if ($errors->any())
                        <div class="mt-3 bg-red-500/20 border border-red-400 text-red-200 p-3 rounded-lg text-xs">
                            @foreach ($errors->all() as $error)
                                <p>• {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="mt-5 space-y-3">
                        @csrf

                        <div>
                            <label class="text-slate-300 text-xs mb-1 block">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full h-10 rounded-lg bg-[#18264d] border border-white/10 text-white px-3 text-sm focus:ring-2 focus:ring-cyan-400 outline-none"
                                placeholder="Enter your full name">
                        </div>

                        <div>
                            <label class="text-slate-300 text-xs mb-1 block">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full h-10 rounded-lg bg-[#18264d] border border-white/10 text-white px-3 text-sm focus:ring-2 focus:ring-cyan-400 outline-none"
                                placeholder="Enter your email">
                        </div>

                        <div>
                            <label class="text-slate-300 text-xs mb-1 block">Password</label>
                            <input type="password" name="password" required
                                class="w-full h-10 rounded-lg bg-[#18264d] border border-white/10 text-white px-3 text-sm focus:ring-2 focus:ring-cyan-400 outline-none"
                                placeholder="Create password">
                        </div>

                        <div>
                            <label class="text-slate-300 text-xs mb-1 block">Confirm Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full h-10 rounded-lg bg-[#18264d] border border-white/10 text-white px-3 text-sm focus:ring-2 focus:ring-cyan-400 outline-none"
                                placeholder="Confirm password">
                        </div>

                        <button type="submit"
                            class="w-full h-10 bg-cyan-400 hover:bg-cyan-300 text-[#0a1024] font-medium rounded-lg transition text-sm">
                            Create Account
                        </button>
                    </form>

                    <p class="mt-4 text-center text-xs text-slate-400">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 transition">
                            Log in here
                        </a>
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection