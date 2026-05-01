@extends('layouts.app')

@section('title', 'Edit Payment')
@section('page-title', 'Edit Payment')

@section('content')

    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-xl bg-red-100 text-red-700 text-sm font-medium shadow-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

            <!-- HEADER -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-slate-800">Edit Payment</h2>
                <p class="text-sm text-slate-400">Update the payment details below.</p>
            </div>

            <form action="{{ route('payments.update', $payment->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- MEMBER -->
                <div>
                    <label for="member_id" class="block text-sm font-medium text-slate-700 mb-2">
                        Member
                    </label>
                    <select name="member_id" id="member_id"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                        <option value="">Select member</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}"
                                {{ old('member_id', $payment->member_id) == $member->id ? 'selected' : '' }}>
                                {{ $member->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- PLAN -->
                <div>
                    <label for="membership_plan_id" class="block text-sm font-medium text-slate-700 mb-2">
                        Membership Plan
                    </label>
                    <select name="membership_plan_id" id="membership_plan_id"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                        <option value="">Select plan</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}"
                                {{ old('membership_plan_id', $payment->membership_plan_id) == $plan->id ? 'selected' : '' }}>
                                {{ $plan->plan_name }} - ₱{{ number_format($plan->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- AMOUNT -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-slate-700 mb-2">
                        Amount
                    </label>
                    <input type="number" step="0.01" name="amount" id="amount"
                        value="{{ old('amount', $payment->amount) }}"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                <!-- PAYMENT DATE -->
                <div>
                    <label for="payment_date" class="block text-sm font-medium text-slate-700 mb-2">
                        Payment Date
                    </label>
                    <input type="date" name="payment_date" id="payment_date"
                        value="{{ old('payment_date', \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d')) }}"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                <!-- EXPIRATION DATE -->
                <div>
                    <label for="expiration_date" class="block text-sm font-medium text-slate-700 mb-2">
                        Expiration Date
                    </label>
                    <input type="date" name="expiration_date" id="expiration_date"
                        value="{{ old('expiration_date', \Carbon\Carbon::parse($payment->expiration_date)->format('Y-m-d')) }}"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                <!-- BUTTONS -->
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition">
                        Update Payment
                    </button>

                    <a href="{{ route('payments.index') }}"
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-medium transition">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

@endsection