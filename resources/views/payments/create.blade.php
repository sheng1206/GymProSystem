@extends('layouts.app')

@section('title', 'Add Payment')
@section('page-title', 'Add Payment')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        <div>
            <a href="{{ route('payments.index') }}"
                class="flex items-center gap-2 px-3 py-1.5 w-fit rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                ← Back
            </a>
        </div>

        <form action="{{ route('payments.store') }}" method="POST"
            class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 space-y-6">
            @csrf

            <div>
                <h2 class="text-2xl font-bold text-gray-800">Add Payment</h2>
                <p class="text-sm text-gray-500 mt-1">Record a new payment or renewal for a member.</p>
            </div>

            @if ($errors->any())
                <div class="rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Member -->
<div>
    <label class="block text-sm font-semibold mb-2 text-gray-700">Member *</label>
    <select name="member_id" id="member_id"
        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
        required>
        <option value="">Select Member</option>
        @foreach ($members as $member)
            @php
                $lastPayment = $member->payments()->latest('payment_date')->first();
            @endphp
            <option value="{{ $member->id }}"
                data-expiration="{{ $lastPayment?->expiration_date }}"
                data-active="{{ $lastPayment && \Carbon\Carbon::parse($lastPayment->expiration_date)->isFuture() ? 'true' : 'false' }}"
                {{ old('member_id') == $member->id ? 'selected' : '' }}>
                {{ $member->full_name }}
            </option>
        @endforeach
    </select>

    <!-- Warning -->
    <div id="activeWarning" class="hidden mt-2 rounded-xl bg-yellow-50 border border-yellow-200 px-4 py-3 text-sm text-yellow-700">
        ⚠️ This member has an active payment until <span id="expirationDate" class="font-semibold"></span>.
    </div>
</div>

                <!-- Plan -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Membership Plan *</label>
                    <select name="membership_plan_id" id="membership_plan_id"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                        <option value="">Select Plan</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}"
                                data-price="{{ $plan->price }}"
                                {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                                {{ $plan->plan_name }} — ₱{{ number_format($plan->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Amount (auto-filled) -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Amount</label>
                    <input type="number" id="amount" name="amount"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-50 outline-none"
                        placeholder="Auto-filled from plan" readonly>
                </div>

                <!-- Payment Date -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Payment Date *</label>
                    <input type="date" name="payment_date"
                        value="{{ old('payment_date', date('Y-m-d')) }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                </div>

            </div>

            <div class="flex items-center gap-3 pt-4 border-t">
                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-sm font-medium text-white transition">
                    Record Payment
                </button>
                <a href="{{ route('payments.index') }}"
                    class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>

    <script>
    const planSelect = document.getElementById('membership_plan_id');
    const amountInput = document.getElementById('amount');
    const memberSelect = document.getElementById('member_id');
    const activeWarning = document.getElementById('activeWarning');
    const expirationDate = document.getElementById('expirationDate');

    planSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const price = selected.getAttribute('data-price');
        amountInput.value = price ? price : '';
    });

    memberSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const isActive = selected.getAttribute('data-active');
        const expiration = selected.getAttribute('data-expiration');

        if (isActive === 'true' && expiration) {
            const date = new Date(expiration);
            expirationDate.textContent = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            activeWarning.classList.remove('hidden');
        } else {
            activeWarning.classList.add('hidden');
        }
    });
</script>
@endsection