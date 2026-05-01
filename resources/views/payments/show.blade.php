@extends('layouts.app')

@section('title', 'Payment Details')
@section('page-title', 'Payment Details')

@section('content')
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <h2 class="text-lg font-semibold text-slate-800 mb-6">Payment Info</h2>

        <div class="space-y-3 text-sm text-slate-700">
            <p><strong>Member:</strong> {{ $payment->member->full_name ?? 'N/A' }}</p>
            <p><strong>Amount:</strong> ₱{{ number_format($payment->amount, 2) }}</p>
            <p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}</p>
            <p><strong>Expiration Date:</strong> {{ \Carbon\Carbon::parse($payment->expiration_date)->format('M d, Y') }}
            </p>

            <p>
                <strong>Status:</strong>
                @if(\Carbon\Carbon::parse($payment->expiration_date)->isFuture() || \Carbon\Carbon::parse($payment->expiration_date)->isToday())
                    <span
                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-600">
                        Paid
                    </span>
                @else
                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-600">
                        Expired
                    </span>
                @endif
            </p>
        </div>

        <div class="mt-6">
            <a href="{{ route('payments.index') }}"
                class="inline-flex items-center rounded-xl bg-slate-700 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800 transition">
                Back
            </a>
        </div>
    </div>
@endsection