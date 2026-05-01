@extends('layouts.app')

@section('title', 'Add Membership Plan')
@section('page-title', 'Add Membership Plan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Add New Plan</h2>
            <p class="text-sm text-gray-500 mb-6">Fill in the details below to create a new membership plan.</p>

            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('plans.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Plan Name</label>
                    <select name="name" id="name"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Plan</option>
                        <option value="Basic" {{ old('name') == 'Basic' ? 'selected' : '' }}>Basic</option>
                        <option value="Pro" {{ old('name') == 'Pro' ? 'selected' : '' }}>Pro</option>
                        <option value="Elite" {{ old('name') == 'Elite' ? 'selected' : '' }}>Elite</option>
                    </select>
                </div>

                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration (Days)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration') }}" placeholder="e.g. 30"
                        readonly class="w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3 focus:outline-none">
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}"
                        placeholder="e.g. 999.00" readonly
                        class="w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3 focus:outline-none">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" id="saveBtn" disabled
                        class="px-5 py-3 bg-blue-600 text-white rounded-xl opacity-50 cursor-not-allowed transition">
                        Save Plan
                    </button>

                    <a href="{{ route('plans.index') }}"
                        class="px-5 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const planSelect = document.getElementById('name');
        const durationInput = document.getElementById('duration');
        const priceInput = document.getElementById('price');
        const saveBtn = document.getElementById('saveBtn');

        planSelect.addEventListener('change', function () {
            const selectedPlan = this.value;

            if (selectedPlan === 'Basic') {
                durationInput.value = 30;
                priceInput.value = 999;
                saveBtn.disabled = false;
                saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
            else if (selectedPlan === 'Pro') {
                durationInput.value = 90;
                priceInput.value = 2499;
                saveBtn.disabled = false;
                saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
            else if (selectedPlan === 'Elite') {
                durationInput.value = 365;
                priceInput.value = 7999;
                saveBtn.disabled = false;
                saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
            else {
                durationInput.value = '';
                priceInput.value = '';
                saveBtn.disabled = true;
                saveBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>

@endsection