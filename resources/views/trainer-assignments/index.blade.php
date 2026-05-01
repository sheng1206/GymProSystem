@extends('layouts.app')

@section('title', 'Trainer Assignments')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-semibold text-gray-700">
                Member–Trainer Overview
            </h1>

            <a href="{{ route('trainer-assignments.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                + Assign Trainer
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm text-left">

                <!-- Head -->
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Member</th>
                        <th class="px-6 py-4">Trainer</th>
                        <th class="px-6 py-4">Start Date</th>
                        <th class="px-6 py-4">End Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="divide-y divide-gray-100">
                    @forelse($assignments as $a)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $a->member->full_name ?? 'N/A' }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $a->trainer->name ?? 'N/A' }}
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $a->start_date }}
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $a->end_date ?? '—' }}
                            </td>

                            <td class="px-6 py-4">
                                @if (!$a->end_date || $a->end_date >= now()->toDateString())
                                    <span
                                        class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-600">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-500">
                                        Ended
                                    </span>
                                @endif
                            </td>


                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('trainer-assignments.show', $a->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition">
                                    View
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-400">
                                No assignments yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
@endsection