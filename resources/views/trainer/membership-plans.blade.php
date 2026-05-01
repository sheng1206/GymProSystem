@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Membership Plans</h2>
            <p class="text-sm text-gray-500 mb-6">View available gym membership plans.</p>

            @if($plans->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 text-left">
                                <th class="py-3 px-4">Plan Name</th>
                                <th class="py-3 px-4">Duration</th>
                                <th class="py-3 px-4">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plans as $plan)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-4">{{ $plan->name }}</td>
                                    <td class="py-3 px-4">{{ $plan->duration }} days</td>
                                    <td class="py-3 px-4">₱{{ number_format($plan->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    No membership plans found.
                </div>
            @endif
        </div>
    </div>
@endsection