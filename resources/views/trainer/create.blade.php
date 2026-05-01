@extends('layouts.app')

@section('title', 'Add Trainer')

@section('content')
    <div class="max-w-2xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Add Trainer</h1>
            <p class="text-slate-400 text-sm">Create a new trainer profile</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('trainers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Trainer Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter trainer name" required>
                </div>

                <!-- Trainer Level -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Trainer Level</label>
                    <select name="specialization"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                        <option value="">Select trainer level</option>
                        <option value="Basic" {{ old('specialization') == 'Basic' ? 'selected' : '' }}>
                            Basic - ₱2,850
                        </option>
                        <option value="Pro" {{ old('specialization') == 'Pro' ? 'selected' : '' }}>
                            Pro - ₱3,500
                        </option>
                        <option value="Elite" {{ old('specialization') == 'Elite' ? 'selected' : '' }}>
                            Elite - ₱5,200
                        </option>
                    </select>
                </div>

                <!-- Photo Upload -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Trainer Photo</label>

                    <input type="file" name="photo" accept="image/*"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 bg-white">

                    <p class="text-xs text-slate-400 mt-2">
                        Optional. JPG, JPEG, or PNG only (Max: 2MB)
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('trainers.index') }}" class="text-sm text-slate-500 hover:text-slate-700">
                        ← Back
                    </a>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                        Save Trainer
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection