@extends('layouts.app')

@section('title', 'Payment History')
@section('page-title', 'Payment History')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Payment History</h2>
            <p class="text-sm text-gray-500">View payment records of assigned members.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Member</th>
                        <th class="px-4 py-3 text-left">Amount</th>
                        <th class="px-4 py-3 text-left">Payment Date</th>
                        <th class="px-4 py-3 text-left">Expiration Date</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            No payment records yet.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection