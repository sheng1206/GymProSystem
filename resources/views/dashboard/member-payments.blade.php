@extends('layouts.app')
@section('title', 'My Payments')
@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800">Payment History</h3>
            <p class="text-sm text-gray-500 mt-1">Your recent payment records</p>
        </div>

        @if($payments->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-6 py-3 text-left">Amount</th>
                            <th class="px-6 py-3 text-left">Payment Date</th>
                            <th class="px-6 py-3 text-left">Expiration</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($payments as $payment)
                            <tr>
                                <td class="px-6 py-4 font-semibold text-slate-800">₱{{ number_format($payment->amount, 2) }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $payment->payment_date }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $payment->expiration_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-6 text-slate-500">No payments found.</div>
        @endif
    </div>
@endsection