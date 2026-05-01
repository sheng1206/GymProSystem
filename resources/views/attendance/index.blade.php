@extends('layouts.app')

@section('title', 'Attendance')
@section('page-title', 'Attendance')

@section('content')

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-slate-800">Attendance</h2>

            <a href="{{ route('attendance.create') }}"
                class="px-4 py-2 bg-slate-700 hover:bg-slate-800 text-white rounded-xl text-sm transition">
                + Record Attendance
            </a>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="text-left text-slate-500 border-b">
                        <th class="py-3">Member</th>
                        <th class="py-3">Check In</th>
                        <th class="py-3">Check Out</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($attendances as $attendance)

                        <tr class="border-b hover:bg-slate-50 transition">

                            <!-- MEMBER -->
                            <td class="py-3 font-medium text-slate-700">
                                {{ $attendance->member->full_name ?? 'N/A' }}
                            </td>

                            <!-- CHECK IN -->
                            <td class="py-3 text-slate-500">
                                {{ $attendance->check_in ?? '—' }}
                            </td>

                            <!-- CHECK OUT -->
                            <td class="py-3 text-slate-500">
                                {{ $attendance->check_out ?? '—' }}
                            </td>

                            <!-- STATUS -->
                            <td class="py-3">
                                @if (!$attendance->check_out)
                                    <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                        Active
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                        Done
                                    </span>
                                @endif
                            </td>

                            <!-- ACTION -->
                            <td class="py-3 text-right">
                                <div class="flex justify-end gap-2">

                                    <!-- VIEW -->
                                    <a href="{{ route('attendance.show', $attendance->id) }}"
                                        class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs transition">
                                        View
                                    </a>

                                    <!-- CHECK OUT -->
                                    @if (!$attendance->check_out)
                                        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="px-3 py-1 bg-slate-700 text-white rounded-lg text-xs hover:bg-slate-800 transition">
                                                Check Out
                                            </button>
                                        </form>
                                    @endif

                                    <!-- DELETE (ADMIN ONLY) -->
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this attendance?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs transition">
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-6 text-slate-400">
                                No attendance records yet
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

@endsection