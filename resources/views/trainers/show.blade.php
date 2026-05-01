@extends('layouts.app')

@section('title', 'View Trainer')
@section('page-title', 'Trainer Details')

@section('content')

    <div class="space-y-6">

        <!-- Top buttons -->
        <div class="flex items-center gap-3">
            <a href="{{ route('trainers.index') }}"
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                Back
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('trainers.edit', $trainer->id) }}"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-100 hover:bg-blue-200 text-sm font-medium text-blue-700 transition">
                    Edit
                </a>
            @endif
        </div>

        <!-- Trainer card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-3xl">
            <div class="flex flex-col items-center text-center mb-6">
                @if($trainer->photo)
                    <img src="{{ asset('storage/' . $trainer->photo) }}" alt="{{ $trainer->name }}"
                        class="w-24 h-24 rounded-full object-cover border border-slate-200 shadow-sm">
                @else
                    <div
                        class="w-24 h-24 rounded-full bg-slate-200 flex items-center justify-center text-slate-700 text-3xl font-bold border border-slate-200">
                        {{ strtoupper(substr($trainer->name, 0, 1)) }}
                    </div>
                @endif

                <h2 class="mt-4 text-2xl font-bold text-slate-800">
                    {{ $trainer->name }}
                </h2>

                <p class="text-sm text-slate-500">Gym Trainer</p>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-500">Name</span>
                    <span class="font-medium text-slate-800">{{ $trainer->name }}</span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-500">Specialization</span>
                    <span class="font-medium text-slate-800">{{ $trainer->specialization }}</span>
                </div>

                <div class="flex justify-between pb-1">
                    <span class="text-slate-500">Photo</span>
                    <span class="font-medium text-slate-800">
                        {{ $trainer->photo ? 'Uploaded' : 'No photo' }}
                    </span>
                </div>
            </div>
        </div>

    </div>

@endsection