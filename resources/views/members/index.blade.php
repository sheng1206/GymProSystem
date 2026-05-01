@extends('layouts.app')

@section('title', 'Members')
@section('page-title', 'Members')

@section('content')

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

        @if (session('success'))
            <div class="mb-4 rounded-xl bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">Members</h2>
                <p class="text-sm text-slate-400">{{ $members->total() }} members</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <form method="GET" action="{{ route('members.index') }}" class="w-full sm:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or contact..."
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400">
                </form>

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                    <a href="{{ route('members.create') }}"
                        class="rounded-xl bg-slate-700 px-4 py-2.5 text-sm text-white hover:bg-slate-800 transition">
                        + Add Member
                    </a>
                @endif
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-left text-slate-500">
                        <th class="py-4">Name</th>
                        <th class="py-4">Contact</th>
                        <th class="py-4">Plan</th>
                        <th class="py-4">Join Date</th>
                        <th class="py-4 text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($members as $member)
                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="py-4 font-medium text-slate-700">{{ $member->full_name }}</td>
                            <td class="py-4 text-slate-500">{{ $member->contact }}</td>
                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-600">
                                    {{ $member->membershipPlan->plan_name ?? 'No Plan' }}
                                </span>
                            </td>
                            <td class="py-4 text-slate-500">
                                {{ \Carbon\Carbon::parse($member->join_date)->format('M d, Y') }}
                            </td>

                            <td class="py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('members.show', $member->id) }}"
                                        class="px-3 py-1 border rounded-lg text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                        View
                                    </a>

                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('members.edit', $member->id) }}"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs hover:bg-blue-200">
                                            Edit
                                        </a>

                                        <!-- DELETE BUTTON triggers modal -->
                                        <button type="button"
                                            onclick="openDeleteModal({{ $member->id }}, '{{ $member->full_name }}')"
                                            class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs hover:bg-red-200">
                                            Delete
                                        </button>

                                        <!-- Hidden form for delete -->
                                        <form id="delete-form-{{ $member->id }}"
                                            action="{{ route('members.destroy', $member->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-400">No members found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-6 flex justify-end">
            {{ $members->links() }}
        </div>

    </div>

    <!-- DELETE CONFIRMATION MODAL -->
    <div id="deleteModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-sm text-center">

            <div class="flex items-center justify-center mb-4">
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2" />
                    </svg>
                </div>
            </div>

            <h2 class="text-lg font-bold text-slate-800 mb-1">Confirm Delete</h2>
            <p class="text-sm text-slate-500 mb-6">Are you sure you want to delete <span id="memberName"
                    class="font-semibold text-slate-700"></span>?</p>

            <div class="flex gap-3 justify-center">
                <button onclick="closeDeleteModal()"
                    class="px-5 py-2 rounded-xl border border-slate-200 text-sm text-slate-600 hover:bg-slate-50 transition">
                    Cancel
                </button>
                <button onclick="confirmDelete()"
                    class="px-5 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600 transition">
                    Yes, Delete
                </button>
            </div>

        </div>
    </div>

    <script>
        let deleteId = null;

        function openDeleteModal(id, name) {
            deleteId = id;
            document.getElementById('memberName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteId = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function confirmDelete() {
            if (deleteId) {
                document.getElementById('delete-form-' + deleteId).submit();
            }
        }
    </script>

@endsection