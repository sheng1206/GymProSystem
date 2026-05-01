@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="space-y-6">

        {{-- Welcome Banner --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white"
            style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #3b82f6 100%);">
            <div class="relative z-10">
                <p class="text-blue-200 text-sm font-medium mb-1">Welcome back 👋</p>
                <h1 class="text-2xl font-bold mb-1">{{ auth()->user()->name }}</h1>
                <p class="text-blue-200 text-sm">Here's what's happening at your gym today.</p>
            </div>
            <div class="absolute right-6 top-1/2 -translate-y-1/2 text-8xl opacity-10">🏋️</div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center text-xl">👥</div>
                    <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">Active</span>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-1">{{ $totalMembers }}</div>
                <div class="text-gray-500 text-sm">Total Members</div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-purple-50 rounded-xl flex items-center justify-center text-xl">🧑‍🏫</div>
                    <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-1 rounded-full">Staff</span>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-1">{{ $totalTrainers }}</div>
                <div class="text-gray-500 text-sm">Total Trainers</div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center text-xl">💰</div>
                    <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">Revenue</span>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-1">₱{{ number_format($totalRevenue, 0) }}</div>
                <div class="text-gray-500 text-sm">Total Revenue</div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-orange-50 rounded-xl flex items-center justify-center text-xl">📅</div>
                    <span class="text-xs font-medium text-orange-500 bg-orange-50 px-2 py-1 rounded-full">Today</span>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-1">{{ $todayAttendance }}</div>
                <div class="text-gray-500 text-sm">Today's Attendance</div>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('members.create') }}"
                class="flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-blue-200 transition-all group">
                <div
                    class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                    ➕
                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-700">Add Member</div>
                    <div class="text-xs text-gray-400">New registration</div>
                </div>
            </a>
            <a href="{{ route('trainers.index') }}"
                class="flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-purple-200 transition-all group">
                <div
                    class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">

                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-700">Trainers</div>
                    <div class="text-xs text-gray-400">Manage trainers</div>
                </div>
            </a>
            <a href="{{ route('payments.index') }}"
                class="flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-green-200 transition-all group">
                <div
                    class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">

                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-700">Payments</div>
                    <div class="text-xs text-gray-400">View records</div>
                </div>
            </a>
            <a href="{{ route('attendance.index') }}"
                class="flex items-center gap-3 bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md hover:border-orange-200 transition-all group">
                <div
                    class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                    📅
                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-700">Attendance</div>
                    <div class="text-xs text-gray-400">Today's logs</div>
                </div>
            </a>
        </div>

        {{-- Recent Members + Payments --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Recent Members --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between p-5 border-b border-gray-50">
                    <div>
                        <h2 class="font-semibold text-gray-800">Recent Members</h2>
                        <p class="text-gray-400 text-xs mt-0.5">Latest registrations</p>
                    </div>
                    <a href="{{ route('members.index') }}"
                        class="text-blue-500 text-sm font-medium hover:text-blue-700 transition-colors">
                        View all →
                    </a>
                </div>
                <div class="p-5 space-y-3">
                    @forelse($recentMembers as $member)
                                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($member->full_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-800 text-sm">{{ $member->full_name }}</div>
                                            <div class="text-gray-400 text-xs">{{ $member->contact }}</div>
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs font-medium px-2.5 py-1 rounded-full
                                                                                                        {{ $member->plan->plan_name ?? '' === 'Elite' ? 'bg-yellow-50 text-yellow-600' :
                        ($member->plan->plan_name ?? '' === 'Pro' ? 'bg-purple-50 text-purple-600' : 'bg-blue-50 text-blue-600') }}">
                                        {{ $member->plan->plan_name ?? 'No Plan' }}
                                    </span>
                                </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="text-4xl mb-2">👥</div>
                            <p class="text-gray-400 text-sm">No members yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Payments --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between p-5 border-b border-gray-50">
                    <div>
                        <h2 class="font-semibold text-gray-800">Recent Payments</h2>
                        <p class="text-gray-400 text-xs mt-0.5">Latest transactions</p>
                    </div>
                    <a href="{{ route('payments.index') }}"
                        class="text-blue-500 text-sm font-medium hover:text-blue-700 transition-colors">
                        View all →
                    </a>
                </div>
                <div class="p-5 space-y-3">
                    @forelse($recentPayments as $payment)
                        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($payment->member->full_name ?? 'N', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800 text-sm">{{ $payment->member->full_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-gray-400 text-xs">{{ $payment->payment_date->format('M d, Y') }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-bold text-green-600">₱{{ number_format($payment->amount, 2) }}</div>
                                <div class="text-xs text-gray-400">Expires {{ $payment->expiration_date->format('M d') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="text-4xl mb-2">💳</div>
                            <p class="text-gray-400 text-sm">No payments yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection