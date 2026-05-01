@extends('layouts.app')

@section('title', 'Trainers')
@section('page-title', 'Trainers')

@section('content')
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Trainer List</h2>
                <p class="text-slate-500 mt-1">View all trainers here.</p>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('trainers.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                    + Add Trainer
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-sm">
                        <th class="text-left px-4 py-4 font-semibold rounded-l-xl">Photo</th>
                        <th class="text-left px-4 py-4 font-semibold">Name</th>
                        <th class="text-left px-4 py-4 font-semibold">Specialization</th>
                        <th class="text-left px-4 py-4 font-semibold rounded-r-xl">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($trainers as $trainer)
                        <tr class="hover:bg-slate-50 transition">

                            <!-- PHOTO -->
                            <td class="px-4 py-4 align-middle">
                                @if($trainer->photo)
                                    <img src="{{ asset('storage/' . $trainer->photo) }}" alt="{{ $trainer->name }}"
                                        class="w-12 h-12 rounded-full object-cover border border-slate-200 shadow-sm">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-700 font-semibold border border-slate-200">
                                        {{ strtoupper(substr($trainer->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            <!-- NAME -->
                            <td class="px-4 py-4 align-middle text-slate-700 font-medium">
                                {{ $trainer->name }}
                            </td>

                            <!-- SPECIALIZATION -->
                            <td class="px-4 py-4 align-middle text-slate-600">
                                {{ $trainer->specialization }}
                            </td>

                            <!-- ACTION -->
                            <td class="px-4 py-4 align-middle">
                                <div class="flex items-center gap-2">

                                    <a href="{{ route('trainers.show', $trainer->id) }}"
                                        class="inline-flex h-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition">
                                        View
                                    </a>

                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('trainers.edit', $trainer->id) }}"
                                            class="inline-flex h-9 items-center justify-center rounded-lg bg-amber-400 px-4 text-sm font-medium text-white hover:bg-amber-500 transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this trainer?');"
                                            class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex h-9 items-center justify-center rounded-lg bg-red-500 px-4 text-sm font-medium text-white hover:bg-red-600 transition">
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-slate-400">
                                No trainers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $trainers->links() }}
        </div>

    </div>
@endsection