@extends('layouts.app')

@section('title', 'Attendance Records')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-slate-800">Attendance Records</h3>
                <p class="text-sm text-slate-500">Attendance of your assigned members</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-6 py-3 text-left">Member</th>
                            <th class="px-6 py-3 text-left">Check In</th>
                            <th class="px-6 py-3 text-left">Check Out</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($attendances as $attendance)
                            <tr>
                                <td class="px-6 py-4">{{ $attendance->member->full_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $attendance->check_in ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $attendance->check_out ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($attendance->check_out)
                                        <span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-600">Completed</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">Active</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">No attendance records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection