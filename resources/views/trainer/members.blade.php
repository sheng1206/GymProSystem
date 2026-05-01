@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Assigned Members</h2>
            <p class="text-sm text-gray-500 mb-6">View all members assigned to you.</p>

            @if($assignedMembers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 text-left">
                                <th class="py-3 px-4">Member Name</th>
                                <th class="py-3 px-4">Contact</th>
                                <th class="py-3 px-4">Join Date</th>
                                <th class="py-3 px-4">Start Date</th>
                                <th class="py-3 px-4">End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedMembers as $assignment)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-4">{{ $assignment->member->full_name ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $assignment->member->contact ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $assignment->member->join_date ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $assignment->start_date ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $assignment->end_date ?? 'Ongoing' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    No assigned members yet.
                </div>
            @endif
        </div>
    </div>
@endsection