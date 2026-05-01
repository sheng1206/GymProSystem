@extends('layouts.app')

@section('title', 'Edit Trainer')
@section('page-title', 'Edit Trainer')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-6">

        <h2 class="text-lg font-semibold text-slate-800 mb-6">Edit Trainer</h2>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('trainers.update', $trainer->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Trainer Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $trainer->name) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-slate-400">
            </div>

            <div>
                <label for="specialization" class="block text-sm font-medium text-slate-700 mb-1">Specialization</label>
                <input type="text" name="specialization" id="specialization"
                    value="{{ old('specialization', $trainer->specialization) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-slate-400">
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('trainers.index') }}"
                    class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium transition">
                    Cancel
                </a>

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-800 text-white text-sm font-medium transition">
                    Update Trainer
                </button>
            </div>
        </form>
    </div>
@endsection