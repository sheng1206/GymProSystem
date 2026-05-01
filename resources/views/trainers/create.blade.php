@extends('layouts.app')

@section('title', 'Add Trainer')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Add Trainer</h2>
                <p class="text-sm text-gray-500">Fill in the trainer details below.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('trainers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trainer Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter trainer name">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Specialization</label>
                    <select name="specialization"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Specialization</option>
                        <option value="Basic" {{ old('specialization') == 'Basic' ? 'selected' : '' }}>Basic</option>
                        <option value="Pro" {{ old('specialization') == 'Pro' ? 'selected' : '' }}>Pro</option>
                        <option value="Elite" {{ old('specialization') == 'Elite' ? 'selected' : '' }}>Elite</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Photo</label>
                    <input type="file" name="photo" id="photo"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white">

                    <img id="preview" class="w-20 h-20 rounded-full object-cover border border-gray-200 mt-3 hidden">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="px-5 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                        Add Trainer
                    </button>

                    <a href="{{ route('trainers.index') }}"
                        class="px-5 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>

    <script>
        const photoInput = document.getElementById('photo');
        const preview = document.getElementById('preview');

        photoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (event) {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection