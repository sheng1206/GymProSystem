@extends('layouts.app')

@section('title', 'View Trainer Assignment')
@section('page-title', 'View Trainer Assignment')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Trainer Assignment Details
            </h2>

            <p class="text-sm text-gray-500 mb-6">
                View the selected member and trainer assignment information.
            </p>

            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Member</p>
                    <p class="font-semibold text-gray-800">
                        {{ $assignment->member->full_name ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Trainer</p>
                    <p class="font-semibold text-gray-800">
                        {{ $assignment->trainer->name ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Start Date</p>
                    <p class="font-semibold text-gray-800">
                        {{ $assignment->start_date }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">End Date</p>
                    <p class="font-semibold text-gray-800">
                        {{ $assignment->end_date ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Status</p>

                    @if (!$assignment->end_date || $assignment->end_date >= now()->toDateString())
                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-600">
                            Active
                        </span>
                    @else
                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-500">
                            Ended
                        </span>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('trainer-assignments.index') }}"
                    class="px-5 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                    Back
                </a>
            </div>

        </div>
    </div>
@endsection