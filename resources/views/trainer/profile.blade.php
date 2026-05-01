@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">My Profile</h2>
        <p class="text-sm text-gray-500 mb-6">View your trainer information.</p>

        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500">Name</p>
                <p class="text-lg font-semibold text-gray-800">{{ $trainer->name }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Specialization</p>
                <p class="text-lg font-semibold text-gray-800">{{ $trainer->specialization }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Photo</p>
                @if($trainer->photo)
                    <img src="{{ asset('storage/' . $trainer->photo) }}" alt="Trainer Photo"
                        class="w-24 h-24 rounded-xl object-cover mt-2">
                @else
                    <p class="text-gray-600">No photo uploaded.</p>
                @endif
            </div>
        </div>
    </div>
@endsection