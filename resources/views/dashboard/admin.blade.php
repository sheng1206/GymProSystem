@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="space-y-5">

        {{-- Welcome Banner --}}
        <div class="mt-2">
            <div class="relative overflow-hidden rounded-2xl px-7 py-6 text-white shadow-lg"
                style="background: linear-gradient(135deg, #0f172a 0%, #1e40af 60%, #3b82f6 100%);">

                <div class="relative z-10">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                            <i data-lucide="hand" class="w-5 h-5 text-white"></i>
                        </div>

                        <div class="space-y-1">
                            <p class="text-blue-200 text-sm leading-none">Welcome back,</p>
                            <h1 class="text-2xl font-bold leading-tight">
                                {{ auth()->user()->name }}
                            </h1>
                        </div>
                    </div>

                    <p class="text-blue-200 text-sm max-w-md mt-3 leading-6">
                        Here's an overview of your gym's performance today. Keep crushing it!
                    </p>

                    <div class="mt-4">
                        <span
                            class="bg-green-400/30 text-green-200 text-xs px-3 py-1 rounded-full font-medium inline-flex items-center gap-1">
                            <i data-lucide="circle" class="w-3 h-3 fill-current"></i>
                            System Online
                        </span>
                    </div>
                </div>

                <div class="absolute right-6 bottom-3 opacity-10">
                    <i data-lucide="dumbbell" class="w-24 h-24"></i>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Members --}}
            <div
                class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-all hover:-translate-y-0.5">

                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>

                    <span class="text-xs font-semibold text-green-500 bg-green-50 px-2 py-0.5 rounded-full">
                        Active
                    </span>
                </div>

                <!-- FIXED PART -->
                <div class="flex justify-between items-end">
                    <div>
                        <div class="text-gray-400 text-sm font-medium">Total Members</div>
                    </div>
                    <div class="text-4xl font-black text-gray-800">
                        {{ $totalMembers }}
                    </div>
                </div>

                <div class="mt-3 h-1 bg-gray-100 rounded-full">
                    <div class="h-1 bg-blue-500 rounded-full" style="width: 75%"></div>
                </div>
            </div>


            {{-- Trainers --}}
            <div
                class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-all hover:-translate-y-0.5">

                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #ede9fe, #ddd6fe);">
                        <i data-lucide="user-cog" class="w-6 h-6 text-purple-600"></i>
                    </div>

                    <span class="text-xs font-semibold text-purple-500 bg-purple-50 px-2 py-0.5 rounded-full">
                        Staff
                    </span>
                </div>

                <!-- FIXED PART -->
                <div class="flex justify-between items-end">
                    <div class="text-gray-400 text-sm font-medium">Total Trainers</div>
                    <div class="text-4xl font-black text-gray-800">
                        {{ $totalTrainers }}
                    </div>
                </div>

                <div class="mt-3 h-1 bg-gray-100 rounded-full">
                    <div class="h-1 bg-purple-500 rounded-full" style="width: 60%"></div>
                </div>
            </div>


            {{-- Revenue --}}
            <div
                class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-all hover:-translate-y-0.5">

                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                        <i data-lucide="wallet" class="w-6 h-6 text-green-600"></i>
                    </div>

                    <span class="text-xs font-semibold text-green-500 bg-green-50 px-2 py-0.5 rounded-full">
                        Revenue
                    </span>
                </div>

                <!-- FIXED PART -->
                <div class="flex justify-between items-end">
                    <div class="text-gray-400 text-sm font-medium">Total Revenue</div>
                    <div class="text-3xl font-black text-gray-800">
                        ₱{{ number_format($totalRevenue, 0) }}
                    </div>
                </div>

                <div class="mt-3 h-1 bg-gray-100 rounded-full">
                    <div class="h-1 bg-green-500 rounded-full" style="width: 85%"></div>
                </div>
            </div>


            {{-- Attendance --}}
            <div
                class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-all hover:-translate-y-0.5">

                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #ffedd5, #fed7aa);">
                        <i data-lucide="calendar-check-2" class="w-6 h-6 text-orange-600"></i>
                    </div>

                    <span class="text-xs font-semibold text-orange-500 bg-orange-50 px-2 py-0.5 rounded-full">
                        Today
                    </span>
                </div>

                <!-- FIXED PART -->
                <div class="flex justify-between items-end">
                    <div class="text-gray-400 text-sm font-medium">Today's Attendance</div>
                    <div class="text-4xl font-black text-gray-800">
                        {{ $todayAttendance }}
                    </div>
                </div>

                <div class="mt-3 h-1 bg-gray-100 rounded-full">
                    <div class="h-1 bg-orange-500 rounded-full" style="width: 40%"></div>
                </div>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">

                <a href="{{ route('members.create') }}"
                    class="group flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-blue-200 transition-all">
                    <div
                        class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-sm shadow-blue-200">
                        <i data-lucide="user-plus" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-700">Add Member</div>
                        <div class="text-xs text-gray-400">New registration</div>
                    </div>
                </a>

                <a href="{{ route('trainers.index') }}"
                    class="group flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-purple-200 transition-all">
                    <div
                        class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-sm shadow-purple-200">
                        <i data-lucide="user-cog" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-700">Trainers</div>
                        <div class="text-xs text-gray-400">Manage trainers</div>
                    </div>
                </a>

                <a href="{{ route('payments.index') }}"
                    class="group flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-green-200 transition-all">
                    <div
                        class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-sm shadow-green-200">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-700">Payments</div>
                        <div class="text-xs text-gray-400">View records</div>
                    </div>
                </a>

                <a href="{{ route('attendance.index') }}"
                    class="group flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-orange-200 transition-all">
                    <div
                        class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-sm shadow-orange-200">
                        <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-700">Attendance</div>
                        <div class="text-xs text-gray-400">Today's logs</div>
                    </div>
                </a>

                <a href="{{ route('trainer-assignments.create') }}"
                    class="group flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-indigo-200 transition-all">
                    <div
                        class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-sm shadow-indigo-200">
                        <i data-lucide="link-2" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-700">Assign Trainer</div>
                        <div class="text-xs text-gray-400">Link trainer & member</div>
                    </div>
                </a>

            </div>
        </div>

        {{-- Recent Members + Payments --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Recent Members --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                    <div>
                        <h2 class="font-bold text-gray-800">Recent Members</h2>
                        <p class="text-gray-400 text-xs mt-0.5">Latest registrations</p>
                    </div>

                    <a href="{{ route('members.index') }}"
                        class="text-sm font-medium text-blue-500 hover:text-blue-700 transition-colors flex items-center gap-1">
                        View all <span>→</span>
                    </a>
                </div>

                <div class="p-4 space-y-1">
                    @forelse($recentMembers as $member)
                        <div
                            class="flex items-center justify-between px-3 py-3 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm"
                                    style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                                    {{ strtoupper(substr($member->full_name, 0, 1)) }}
                                </div>

                                <div>
                                    <div class="font-semibold text-gray-800 text-sm">{{ $member->full_name }}</div>
                                    <div class="text-gray-400 text-xs">{{ $member->contact }}</div>
                                </div>
                            </div>

                            @php $plan = $member->plan->plan_name ?? 'No Plan'; @endphp

                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                                        @if($plan === 'Elite') bg-yellow-50 text-yellow-600
                                                        @elseif($plan === 'Pro') bg-purple-50 text-purple-600
                                                        @else bg-blue-50 text-blue-600 @endif">
                                {{ $plan }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <i data-lucide="users" class="w-10 h-10 mx-auto text-gray-300 mb-3"></i>
                            <p class="text-gray-400 text-sm font-medium">No members yet</p>
                            <a href="{{ route('members.create') }}" class="text-blue-500 text-xs mt-1 hover:underline">
                                Add first member →
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Payments --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                    <div>
                        <h2 class="font-bold text-gray-800">Recent Payments</h2>
                        <p class="text-gray-400 text-xs mt-0.5">Latest transactions</p>
                    </div>

                    <a href="{{ route('payments.index') }}"
                        class="text-sm font-medium text-blue-500 hover:text-blue-700 transition-colors flex items-center gap-1">
                        View all <span>→</span>
                    </a>
                </div>

                <div class="p-4 space-y-1">
                    @forelse($recentPayments as $payment)
                        <div class="flex items-center justify-between px-3 py-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm"
                                    style="background: linear-gradient(135deg, #10b981, #059669);">
                                    {{ strtoupper(substr($payment->member->full_name ?? 'N', 0, 1)) }}
                                </div>

                                <div>
                                    <div class="font-semibold text-gray-800 text-sm">
                                        {{ $payment->member->full_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-gray-400 text-xs">
                                        {{ $payment->payment_date->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-sm font-bold text-green-600">
                                    ₱{{ number_format($payment->amount, 2) }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    Exp. {{ $payment->expiration_date->format('M d') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <i data-lucide="credit-card" class="w-10 h-10 mx-auto text-gray-300 mb-3"></i>
                            <p class="text-gray-400 text-sm font-medium">No payments yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection