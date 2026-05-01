@extends('layouts.app')

@section('title', 'Attendance Details')
@section('page-title', 'Attendance Details')

@section('content')

    <div class="bg-white p-6 rounded-2xl shadow-sm border">

        <h2 class="text-lg font-semibold mb-4">Attendance Info</h2>

        <div class="space-y-2 text-sm text-slate-700">

            <p>
                <strong>Check In:</strong>
                {{ \Carbon\Carbon::parse($attendance->check_in)->format('M d, Y h:i A') }}
            </p>

            <p>
                <strong>Check Out:</strong>
                {{ $attendance->check_out
        ? \Carbon\Carbon::parse($attendance->check_out)->format('M d, Y h:i A')
        : '—' }}
            </p>

            <p>
                <strong>Status:</strong>

                @if ($attendance->check_out)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                        Completed
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                        Active Session
                    </span>
                @endif
            </p>
        </div>

        <a href="{{ route('attendance.index') }}" class="inline-block mt-6 px-4 py-2 bg-slate-700 text-white rounded-lg">
            Back
        </a>

    </div>

@endsection