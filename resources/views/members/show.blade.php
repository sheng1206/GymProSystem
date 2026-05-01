@extends('layouts.app')

@section('title', 'View Member')

@section('content')
    <div class="space-y-6">

        <!-- Top buttons -->
        <div class="flex items-center gap-3">

            <!-- Back Button -->
            <a href="{{ route('members.index') }}"
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>

            <!-- Edit Button -->
            <a href="{{ route('members.edit', $member->id) }}"
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-100 hover:bg-blue-200 text-sm font-medium text-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2M12 7v10m-6 0h12" />
                </svg>
                Edit
            </a>

        </div>

        <!-- Main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT SIDE: Member Info -->
            <div class="lg:col-span-1 bg-white rounded-2xl shadow p-6">
                <div class="flex flex-col items-center text-center mb-6">
                    <div
                        class="w-20 h-20 rounded-2xl bg-slate-700 text-white flex items-center justify-center text-3xl font-bold">
                        {{ strtoupper(substr($member->full_name, 0, 1)) }}
                    </div>

                    <h2 class="mt-4 text-2xl font-bold text-gray-800">
                        {{ $member->full_name }}
                    </h2>

                    <p class="text-sm text-gray-500">Gym Member</p>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Contact</span>
                        <span class="font-medium text-gray-800">{{ $member->contact }}</span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Membership Plan</span>
                        <span class="font-medium text-gray-800">
                            {{ $member->membershipPlan->plan_name ?? 'No Plan' }}
                        </span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Join Date</span>
                        <span class="font-medium text-gray-800">
                            {{ \Carbon\Carbon::parse($member->join_date)->format('M d, Y') }}
                        </span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Payments</span>
                        <span class="font-bold text-gray-800">
                            {{ $member->payments->count() }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Attendance</span>
                        <span class="font-bold text-gray-800">
                            {{ $member->attendances->count() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Payment + Attendance -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Payment History -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Payment History</h3>

                    @if($member->payments->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left border-collapse">
                                <thead>
                                    <tr class="border-b text-gray-600">
                                        <th class="py-3 pr-4">Amount</th>
                                        <th class="py-3 pr-4">Payment Date</th>
                                        <th class="py-3 pr-4">Expiration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($member->payments as $payment)
                                        <tr class="border-b last:border-b-0">
                                            <td class="py-3 pr-4 font-medium">₱{{ number_format($payment->amount, 2) }}</td>
                                            <td class="py-3 pr-4">
                                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}
                                            </td>
                                            <td class="py-3 pr-4">
                                                {{ \Carbon\Carbon::parse($payment->expiration_date)->format('M d, Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No payment history yet.</p>
                    @endif
                </div>

                <!-- Attendance -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Attendance</h3>

                    @if($member->attendances->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left border-collapse">
                                <thead>
                                    <tr class="border-b text-gray-600">
                                        <th class="py-3 pr-4">Check In</th>
                                        <th class="py-3 pr-4">Check Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($member->attendances as $attendance)
                                        <tr class="border-b last:border-b-0">
                                            <td class="py-3 pr-4">
                                                {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('M d, Y h:i A') : '—' }}
                                            </td>
                                            <td class="py-3 pr-4">
                                                {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('M d, Y h:i A') : '—' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No attendance records yet.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection