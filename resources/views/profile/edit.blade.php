
@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl">
        <form action="{{ route('profile.update') }}" method="POST" class="card p-6 space-y-6">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $member->full_name ?? '') }}"
                        class="form-input w-full" required>
                    @error('full_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Contact *</label>
                    <input type="text" name="contact" value="{{ old('contact', $member->contact ?? '') }}"
                        class="form-input w-full" required>
                    @error('contact')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Membership Plan</label>
                    <select name="membership_plan_id" class="form-input w-full">
                        <option value="">No Plan</option>
                        @foreach($membershipPlans as $plan)
                            <option value="{{ $plan->id }}" {{ $member && $member->membership_plan_id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->plan_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Join Date</label>
                    <input type="date" name="join_date" value="{{ old('join_date', $member->join_date ?? '') }}"
                        class="form-input w-full">
                    @error('join_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection