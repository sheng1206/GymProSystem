@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-[#0a1024] flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-[#111c3d] p-8 rounded-2xl border border-white/10 shadow-xl">

            <h2 class="text-white text-xl font-semibold">Forgot Password</h2>
            <p class="text-slate-400 text-sm mt-1">
                Enter your email and we’ll send a reset link.
            </p>

            <!-- SUCCESS MESSAGE -->
            @if (session('status'))
                <div class="mt-4 bg-green-500/20 border border-green-400 text-green-200 p-3 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- ERRORS -->
            @if ($errors->any())
                <div class="mt-3 bg-red-500/20 border border-red-400 text-red-200 p-3 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label class="text-slate-300 text-sm mb-1 block">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full h-10 rounded-lg bg-[#18264d] border border-white/10 text-white px-3 text-sm focus:ring-2 focus:ring-cyan-400 outline-none"
                        placeholder="Enter your email">
                </div>

                <button type="submit"
                    class="w-full h-10 bg-cyan-400 hover:bg-cyan-300 text-[#0a1024] font-medium rounded-lg transition text-sm">
                    Send Reset Link
                </button>
            </form>

            <p class="mt-4 text-center text-xs text-slate-400">
                Remember your password?
                <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300">
                    Back to login
                </a>
            </p>

        </div>

    </div>
@endsection