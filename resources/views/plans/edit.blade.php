@extends('layouts.app')

@section('title', 'Edit Plan')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Edit Membership Plan</h2>
                <p class="text-sm text-gray-500">Update the membership plan details below.</p>
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

            <form action="{{ route('plans.update', $plan->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Plan Name</label>
                    <select name="name" id="name"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Plan</option>
                        <option value="Basic" {{ old('name', $plan->plan_name) == 'Basic' ? 'selected' : '' }}>Basic</option>
                        <option value="Pro" {{ old('name', $plan->plan_name) == 'Pro' ? 'selected' : '' }}>Pro</option>
                        <option value="Elite" {{ old('name', $plan->plan_name) == 'Elite' ? 'selected' : '' }}>Elite</option>
                    </select>
                </div>

                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration (Days)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $plan->duration_days) }}"
                        readonly class="w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3 focus:outline-none">
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $plan->price) }}"
                        readonly class="w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3 focus:outline-none">
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('plans.index') }}"
                        class="px-5 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-5 py-3 bg-slate-700 text-white rounded-xl hover:bg-slate-800 transition">
                        Update Plan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const planSelect = document.getElementById('name');
        const durationInput = document.getElementById('duration');
        const priceInput = document.getElementById('price');

        function updatePlanFields() {
            const selectedPlan = planSelect.value;

            if (selectedPlan === 'Basic') {
                durationInput.value = 30;
                priceInput.value = 999;
            } else if (selectedPlan === 'Pro') {
                durationInput.value = 90;
                priceInput.value = 2499;
            } else if (selectedPlan === 'Elite') {
                durationInput.value = 365;
                priceInput.value = 7999;
            } else {
                durationInput.value = '';
                priceInput.value = '';
            }
        }

        planSelect.addEventListener('change', updatePlanFields);
    </script>
@endsection