@extends('layouts.app')
@section('title', 'My Attendance')
@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800">My Attendance</h3>
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
                                <td class="px-6 py-4 text-slate-600">{{ $attendance->check_out ?? '—' }}</td>
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
            <div class="px-6 py-6 text-slate-500">No attendance records.</div>
        @endif
    </div>
@endsection