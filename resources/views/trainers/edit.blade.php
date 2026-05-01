@extends('layouts.app')

@section('title', 'Edit Trainer')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('trainers.index') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900 transition">
                ← Back
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">Edit Trainer</h2>
                <p class="text-slate-500 mt-1">Update trainer details below.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('trainers.update', $trainer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- TRAINER NAME -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                            Trainer Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $trainer->name) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 bg-white text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 ring-red-200 @enderror"
                            placeholder="Enter trainer name">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SPECIALIZATION -->
                    <div>
                        <label for="specialization" class="block text-sm font-semibold text-slate-700 mb-2">
                            Specialization
                        </label>
                        <select name="specialization" id="specialization"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 bg-white text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('specialization') border-red-400 ring-red-200 @enderror">
                            <option value="Basic" {{ old('specialization', $trainer->specialization) == 'Basic' ? 'selected' : '' }}>
                                Basic
                            </option>
                            <option value="Pro" {{ old('specialization', $trainer->specialization) == 'Pro' ? 'selected' : '' }}>
                                Pro
                            </option>
                            <option value="Elite" {{ old('specialization', $trainer->specialization) == 'Elite' ? 'selected' : '' }}>
                                Elite
                            </option>
                        </select>
                        @error('specialization')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PHOTO -->
                    <div class="md:col-span-2">
                        <label for="photo" class="block text-sm font-semibold text-slate-700 mb-2">
                            Trainer Photo
                        </label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="block w-full rounded-xl border border-slate-300 px-4 py-3 bg-white text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('photo') border-red-400 ring-red-200 @enderror">
                        @error('photo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CURRENT / PREVIEW PHOTO -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Current Photo</label>

                        <div class="flex items-center gap-4 flex-wrap">
                            @if($trainer->photo)
                                <img src="{{ asset('storage/' . $trainer->photo) }}" alt="{{ $trainer->name }}"
                                    class="w-24 h-24 rounded-2xl object-cover border border-slate-200" id="currentPhoto">
                            @else
                                <div id="currentPhotoPlaceholder"
                                    class="w-24 h-24 rounded-2xl bg-slate-200 flex items-center justify-center text-slate-700 text-3xl font-bold border border-slate-200">
                                    {{ strtoupper(substr($trainer->name, 0, 1)) }}
                                </div>
                            @endif

                            <img id="preview" class="w-24 h-24 rounded-2xl object-cover border border-slate-200 hidden"
                                alt="Photo Preview">
                        </div>

                        <p class="text-xs text-slate-500 mt-3">
                            Upload a new image only if you want to replace the current trainer photo.
                        </p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-200 flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">
                        Update Trainer
                    </button>

                    <a href="{{ route('trainers.index') }}"
                        class="px-6 py-3 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const photoInput = document.getElementById('photo');
        const preview = document.getElementById('preview');
        const currentPhoto = document.getElementById('currentPhoto');
        const currentPhotoPlaceholder = document.getElementById('currentPhotoPlaceholder');

        photoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (event) {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');

                    if (currentPhoto) {
                        currentPhoto.classList.add('hidden');
                    }

                    if (currentPhotoPlaceholder) {
                        currentPhotoPlaceholder.classList.add('hidden');
                    }
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');

                if (currentPhoto) {
                    currentPhoto.classList.remove('hidden');
                }

                if (currentPhotoPlaceholder) {
                    currentPhotoPlaceholder.classList.remove('hidden');
                }
            }
        });
    </script>
@endsection