@extends('layouts.app')

@section('title', 'Trainer Dashboard')

@section('content')
    <div class="space-y-5">

        {{-- Welcome Banner --}}
        <div class="mt-2">
            <div class="relative overflow-hidden rounded-2xl px-7 py-6 text-white shadow-lg"
                style="background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 60%, #60a5fa 100%);">

                <div class="relative z-10">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                            <i data-lucide="user-cog" class="w-5 h-5 text-white"></i>
                        </div>

                        <div class="space-y-1">
                            <p class="text-blue-200 text-sm leading-none">Welcome back,</p>
                            <h1 class="text-2xl font-bold leading-tight">
                                {{ auth()->user()->name }}
                            </h1>
                        </div>
                    </div>

                    <p class="text-blue-200 text-sm max-w-md mt-3 leading-6">
                        Here’s a quick overview of your assigned members and specialization.
                    </p>

                    <div class="mt-4">
                        <span
                            class="bg-green-400/30 text-green-200 text-xs px-3 py-1 rounded-full font-medium inline-flex items-center gap-1">
                            <i data-lucide="circle" class="w-3 h-3 fill-current"></i>
                            Trainer Active
                        </span>
                    </div>
                </div>

                <div class="absolute right-6 bottom-3 opacity-10">
                    <i data-lucide="dumbbell" class="w-24 h-24"></i>
                </div>
            </div>
        </div>

        {{-- Top Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Specialization Card --}}
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                        <i data-lucide="badge-check" class="w-7 h-7 text-blue-600"></i>
                    </div>

                    <div>
                        <p class="text-sm text-slate-400">Specialization</p>
                        <h3 class="text-xl font-bold text-slate-800">
                            {{ $trainer->specialization ?? 'Not set' }}
                        </h3>
                    </div>
                </div>
            </div>

            {{-- Assigned Members Count --}}
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                        <i data-lucide="users" class="w-7 h-7 text-green-600"></i>
                    </div>

                    <div>
                        <p class="text-sm text-slate-400">Assigned Members</p>
                        <h3 class="text-xl font-bold text-slate-800">
                            {{ $members->count() }}
                        </h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- Assigned Members --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <div>
                    <h2 class="font-bold text-slate-800">Your Assigned Members</h2>
                    <p class="text-slate-400 text-xs mt-0.5">
                        {{ $members->count() }} total assigned member{{ $members->count() == 1 ? '' : 's' }}
                    </p>
                </div>
            </div>

            <div class="p-4 space-y-2">
                @forelse ($members as $member)
                    <div class="flex items-center justify-between px-4 py-4 rounded-xl hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-11 h-11 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold text-sm">
                                {{ strtoupper(substr($member->full_name, 0, 1)) }}
                            </div>

                            <div>
                                <p class="font-semibold text-slate-800 text-sm">{{ $member->full_name }}</p>
                                <p class="text-xs text-slate-400">{{ $member->contact }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if(($member->membershipPlan->plan_name ?? '') === 'Elite') bg-yellow-50 text-yellow-600
                                        @elseif(($member->membershipPlan->plan_name ?? '') === 'Pro') bg-purple-50 text-purple-600
                                        @elseif(($member->membershipPlan->plan_name ?? '') === 'Basic') bg-blue-50 text-blue-600
                                        @else bg-slate-100 text-slate-500 @endif">
                                {{ $member->membershipPlan->plan_name ?? 'No Plan' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <i data-lucide="users" class="w-10 h-10 mx-auto text-slate-300 mb-3"></i>
                        <p class="text-slate-400 text-sm font-medium">No assigned members yet</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection