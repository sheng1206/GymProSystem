@extends('layouts.app')

@section('title', 'Staff Dashboard')
@section('page-title', 'Staff Dashboard')

@section('content')
    <div class="space-y-8">

        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-md">
            <h2 class="text-3xl font-bold">Staff Dashboard</h2>
            <p class="mt-2 text-sm text-blue-100">
                Welcome back, {{ auth()->user()->name }}! Manage member registration, payments, attendance, and daily gym
                operations here.
            </p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- Total Members -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Members</p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800">{{ $totalMembers ?? 0 }}</h3>
                        <p class="mt-1 text-sm text-gray-400">Registered gym members</p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            <!-- Today's Attendance -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Today's Attendance</p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800">{{ $todayAttendance ?? 0 }}</h3>
                        <p class="mt-1 text-sm text-gray-400">Members checked in today</p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <i data-lucide="calendar-check" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            <!-- Quick Action -->
            <a href="{{ route('members.create') }}"
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-blue-200 transition block">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Quick Action</p>
                        <h3 class="mt-3 text-xl font-bold text-blue-600">Add New Member</h3>
                        <p class="mt-1 text-sm text-gray-400">Register a new gym member</p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <i data-lucide="user-plus" class="w-6 h-6"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Staff Actions -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-800">Staff Actions</h3>
                <p class="text-sm text-gray-500 mt-1">Quick access to daily gym tasks</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                <a href="{{ route('members.create') }}"
                    class="group rounded-2xl border border-gray-100 bg-slate-50 p-5 hover:bg-blue-50 hover:border-blue-200 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                            <i data-lucide="user-plus" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Register New Member</h4>
                            <p class="text-sm text-gray-500">Add a new member account</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('members.index') }}"
                    class="group rounded-2xl border border-gray-100 bg-slate-50 p-5 hover:bg-emerald-50 hover:border-emerald-200 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                            <i data-lucide="file-pen-line" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Update Member Details</h4>
                            <p class="text-sm text-gray-500">Edit member information</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('payments.index') }}"
                    class="group rounded-2xl border border-gray-100 bg-slate-50 p-5 hover:bg-green-50 hover:border-green-200 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                            <i data-lucide="credit-card" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Record Payments</h4>
                            <p class="text-sm text-gray-500">Add new payment records</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('plans.index') }}"
                    class="group rounded-2xl border border-gray-100 bg-slate-50 p-5 hover:bg-purple-50 hover:border-purple-200 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                            <i data-lucide="badge-dollar-sign" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">View Membership Plans</h4>
                            <p class="text-sm text-gray-500">Check available gym plans</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('attendance.index') }}"
                    class="group rounded-2xl border border-gray-100 bg-slate-50 p-5 hover:bg-orange-50 hover:border-orange-200 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                            <i data-lucide="calendar-check-2" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">View Attendance</h4>
                            <p class="text-sm text-gray-500">Monitor attendance logs</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('trainer-assignments.create') }}"
                    class="group rounded-2xl border border-gray-100 bg-slate-50 p-5 hover:bg-indigo-50 hover:border-indigo-200 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                            <i data-lucide="user-cog" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Assign Trainers</h4>
                            <p class="text-sm text-gray-500">Link trainer to member</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>

        <!-- Recent Members -->
        <div class="bg-white rounded-2xl shadow-sm border border-green-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-green-600">Recent Members</h3>
                    <p class="text-sm text-gray-500 mt-1">Latest registered members in the system</p>
                </div>

                <a href="{{ route('members.index') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-sm font-medium text-blue-600 transition">
                    View all
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            @if(isset($recentMembers) && $recentMembers->count())
                <div class="space-y-4">
                    @foreach($recentMembers as $member)
                        <div
                            class="flex items-center justify-between p-4 rounded-xl hover:bg-gray-50 transition border border-gray-100">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-11 h-11 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr($member->full_name, 0, 1)) }}
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $member->full_name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $member->contact }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600">
                                    {{ $member->membershipPlan->plan_name ?? 'No Plan' }}
                                </span>

                                <a href="{{ route('members.show', $member->id) }}"
                                    class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mb-4">
                        <i data-lucide="users" class="w-7 h-7"></i>
                    </div>
                    <p class="text-gray-500">No recent members yet.</p>
                </div>
            @endif
        </div>
    </div>
@endsection