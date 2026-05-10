@extends('layouts.app')

@section('title', 'Edit Member')
@section('page-title', 'Edit Member')

@section('content')

    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Back button -->
        <div>
            <a href="{{ route('members.show', $member->id) }}"
                class="flex items-center gap-2 px-3 py-1.5 w-fit rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        {{-- FORM CARD --}}
        <form action="{{ route('members.update', $member->id) }}" method="POST"
            class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 space-y-6">

            @csrf
            @method('PUT')

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

                {{-- USER ACCOUNT --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">User Account *</label>
                    <select name="user_id"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                        <option value="">Select User Account</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $member->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} — {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- FULL NAME --}}
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Full Name *</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $member->full_name) }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                    @error('full_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CONTACT --}}
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Contact *</label>
                    <input type="text" name="contact" value="{{ old('contact', $member->contact) }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                    @error('contact')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- MEMBERSHIP PLAN --}}
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Membership Plan *</label>
                    <select name="membership_plan_id"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                        <option value="">Select Plan</option>
                        @foreach ($membershipPlans as $plan)
                            <option value="{{ $plan->id }}" {{ old('membership_plan_id', $member->membership_plan_id) == $plan->id ? 'selected' : '' }}>
                                {{ $plan->plan_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('membership_plan_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- JOIN DATE --}}
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Join Date *</label>
                    <input type="date" name="join_date"
                        value="{{ old('join_date', \Carbon\Carbon::parse($member->join_date)->format('Y-m-d')) }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                    @error('join_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- BUTTONS --}}
            <div class="flex items-center gap-3 pt-4 border-t">

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-100 hover:bg-blue-200 text-sm font-medium text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update
                </button>

                <a href="{{ route('members.show', $member->id) }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </a>

            </div>

        </form>
    </div>

@endsection