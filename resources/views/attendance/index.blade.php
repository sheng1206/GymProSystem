@extends('layouts.app')

@section('title', 'Attendance')
@section('page-title', 'Attendance')

@section('content')

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="mb-4 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700 font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- ERROR MESSAGE -->
        @if(session('error'))
            <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700 font-medium">
                ⚠️ {{ session('error') }}
            </div>
        @endif

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
                                        <button type="button"
                                            onclick="openDeleteModal({{ $attendance->id }}, '{{ $attendance->member->full_name ?? 'this record' }}')"
                                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs transition">
                                            Delete
                                        </button>

                                        <form id="delete-form-{{ $attendance->id }}"
                                            action="{{ route('attendance.destroy', $attendance->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
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

    <!-- DELETE MODAL -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

        {{-- Modal Box --}}
        <div class="relative bg-white rounded-2xl shadow-xl p-8 w-full max-w-sm mx-4 text-center z-10">

            {{-- Trash Icon --}}
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-red-100 mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <h3 class="text-lg font-bold text-slate-800">Confirm Delete</h3>
            <p class="text-sm text-slate-500 mt-2">
                Are you sure you want to delete <span id="modalMemberName" class="font-semibold text-slate-700"></span>?
            </p>

            <div class="flex items-center justify-center gap-3 mt-6">
                <button onclick="closeDeleteModal()"
                    class="px-5 py-2 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
                    Cancel
                </button>
                <button onclick="submitDelete()"
                    class="px-5 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white text-sm font-medium transition">
                    Yes, Delete
                </button>
            </div>

        </div>
    </div>

    <script>
        let deleteId = null;

        function openDeleteModal(id, name) {
            deleteId = id;
            document.getElementById('modalMemberName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteId = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function submitDelete() {
            if (deleteId) {
                document.getElementById('delete-form-' + deleteId).submit();
            }
        }
    </script>

@endsection