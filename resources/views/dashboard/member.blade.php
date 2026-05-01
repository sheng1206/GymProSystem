@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="space-y-6">

        {{-- Welcome Banner --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-6 text-white shadow-md">
            <h2 class="text-3xl font-bold">Welcome to GymPro, {{ auth()->user()->name }}!</h2>
            <p class="mt-2 text-sm text-blue-100">
                Stay updated with your membership, payments, attendance, and trainer information.
            </p>

            <div class="mt-4 flex flex-wrap gap-3">
                <span class="px-3 py-1 rounded-full bg-white/20 text-sm font-medium">
                    Member Access
                </span>
                <span class="px-3 py-1 rounded-full bg-white/20 text-sm font-medium">
                    {{ now()->format('l, F d, Y') }}
                </span>
            </div>
        </div>

        {{-- Top Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

            {{-- Membership Plan --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Membership Plan</p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800">
                            {{ $member && $member->membershipPlan ? $member->membershipPlan->plan_name : 'No Plan Yet' }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-400">Current membership plan</p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                        <i data-lucide="badge-check" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            {{-- Payments --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Payments</p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800">
                            {{ $payments->count() }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-400">Total payment records</p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-600">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            {{-- Attendance --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Attendance</p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800">
                            {{ $attendances->count() }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-400">Attendance logs</p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600">
                        <i data-lucide="calendar-check-2" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            {{-- Assigned Trainer --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Assigned Trainer</p>
                        <h3 class="mt-3 text-2xl font-bold text-gray-800">
                            {{ $trainer ? $trainer->name : 'No Trainer' }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-400">Current assigned trainer</p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                        <i data-lucide="user-round-cog" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profile --}}
        <div id="profile" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">My Profile</h3>
                    <p class="text-sm text-gray-500 mt-1">Your personal gym information</p>
                </div>

                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition">
                    <i data-lucide="square-pen" class="w-4 h-4"></i>
                    Edit Profile Info
                </a>
            </div>

            @if($member)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Full Name</p>
                        <p class="font-semibold text-slate-800">{{ $member->full_name }}</p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Contact</p>
                        <p class="font-semibold text-slate-800">{{ $member->contact }}</p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Join Date</p>
                        <p class="font-semibold text-slate-800">{{ $member->join_date }}</p>
                    </div>
                </div>
            @else
                <div class="rounded-xl border border-dashed border-slate-200 p-6 text-slate-500">
                    No member profile found.
                </div>
            @endif
        </div>

        {{-- Membership + Trainer --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Membership Plan</h3>

                @if($member && $member->membershipPlan)
                    <div class="rounded-xl bg-blue-50 border border-blue-100 p-5">
                        <p class="text-2xl font-bold text-blue-700">{{ $member->membershipPlan->plan_name }}</p>

                        @if(isset($member->membershipPlan->price))
                            <p class="mt-2 text-sm text-slate-600">
                                Price: ₱{{ number_format($member->membershipPlan->price, 2) }}
                            </p>
                        @endif

                        @if(isset($member->membershipPlan->duration))
                            <p class="text-sm text-slate-600">
                                Duration: {{ $member->membershipPlan->duration }} days
                            </p>
                        @endif
                    </div>
                @else
                    <p class="text-slate-500">No Plan Yet</p>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Assigned Trainer</h3>

                @if($trainer)
                    <div class="rounded-xl bg-purple-50 border border-purple-100 p-5">
                        <p class="text-2xl font-bold text-purple-700">{{ $trainer->name }}</p>
                        <p class="mt-2 text-sm text-slate-600">
                            Specialization: {{ $trainer->specialization ?? 'Not specified' }}
                        </p>
                    </div>
                @else
                    <p class="text-slate-500">No trainer assigned.</p>
                @endif
            </div>
        </div>

        {{-- Payments --}}
        <div id="payments" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800">Payment History</h3>
                <p class="text-sm text-gray-500 mt-1">Your recent payment records</p>
            </div>

            @if($payments->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-500">
                            <tr>
                                <th class="px-6 py-3 text-left">Amount</th>
                                <th class="px-6 py-3 text-left">Payment Date</th>
                                <th class="px-6 py-3 text-left">Expiration</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($payments as $payment)
                                <tr>
                                    <td class="px-6 py-4 font-semibold text-slate-800">
                                        ₱{{ number_format($payment->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $payment->payment_date }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $payment->expiration_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-6 text-slate-500">
                    No payments found.
                </div>
            @endif
        </div>

        {{-- Attendance --}}
        <div id="attendance" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800">Attendance</h3>
                <p class="text-sm text-gray-500 mt-1">Your attendance records</p>
            </div>

            @if($attendances->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-500">
                            <tr>
                                <th class="px-6 py-3 text-left">Check In</th>
                                <th class="px-6 py-3 text-left">Check Out</th>
                                <th class="px-6 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td class="px-6 py-4 text-slate-800">{{ $attendance->check_in }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $attendance->check_out ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if($attendance->check_out)
                                            <span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600">Completed</span>
                                        @else
                                            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-600">Active</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-6 text-slate-500">
                    No attendance records.
                </div>
            @endif
        </div>

    </div>
@endsection