@extends('layouts.app')

@section('title', 'Add Member')
@section('page-title', 'Add Member')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Back button -->
        <div>
            <a href="{{ route('members.index') }}"
                class="flex items-center gap-2 px-3 py-1.5 w-fit rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                ← Back
            </a>
        </div>

        <!-- Form card -->
        <form action="{{ route('members.store') }}" method="POST"
            class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 space-y-6">
            @csrf

            <!-- Heading -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Add New Member</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Fill in the member details and payment information below.
                </p>
            </div>

            <!-- Error messages -->
            @if ($errors->any())
                <div class="rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Member Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Member Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Full Name *</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Enter full name" required>
                    </div>

                    <!-- Contact -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Contact *</label>
                        <input type="text" name="contact" value="{{ old('contact') }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Enter contact number" required>
                    </div>

                    <!-- Membership Plan -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Membership Plan *</label>
                        <select name="membership_plan_id" id="membership_plan_id"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            required>
                            <option value="">Select Plan</option>
                            @foreach ($membershipPlans as $plan)
                                <option value="{{ $plan->id }}"
                                    data-price="{{ $plan->price }}"
                                    {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->plan_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Join Date -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Join Date *</label>
                        <input type="date" name="join_date" value="{{ old('join_date') }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            required>
                    </div>

                </div>
            </div>

            <!-- Payment Information -->
            <div class="pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-800">Payment Information</h3>
                <p class="text-sm text-gray-500 mt-1 mb-4">
                    Payment is required before adding a member.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Amount *</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Select a plan first" required readonly>
                    </div>

                    <!-- Payment Date -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Payment Date *</label>
                        <input type="date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            required>
                    </div>

                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t">

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-sm font-medium text-white transition">
                    + Add Member & Pay
                </button>

                <a href="{{ route('members.index') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                    Cancel
                </a>

            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const membershipPlan = document.getElementById('membership_plan_id');
            const amountInput = document.getElementById('amount');

            function updateAmount() {
                const selectedOption = membershipPlan.options[membershipPlan.selectedIndex];
                const price = selectedOption.getAttribute('data-price');

                amountInput.value = price ? price : '';
            }

            membershipPlan.addEventListener('change', updateAmount);

            updateAmount();
        });
    </script>
@endsection