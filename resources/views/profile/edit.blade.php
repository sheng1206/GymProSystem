@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl">
        @if(session('status') === 'profile-updated')
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">Profile updated successfully!</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="card p-6 space-y-6">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $member->full_name ?? '') }}"
                        class="form-input w-full" required>
                    @error('full_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Contact *</label>
                    <input type="text" name="contact" value="{{ old('contact', $member->contact ?? '') }}"
                        class="form-input w-full" required>
                    @error('contact') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                        class="form-input w-full" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Membership Plan</label>
                    <input type="text"
                        value="{{ $member && $member->membershipPlan ? $member->membershipPlan->plan_name : 'No Plan' }}"
                        class="form-input w-full bg-slate-100 cursor-not-allowed" disabled>
                    <p class="text-slate-400 text-xs mt-1">Managed by admin</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Join Date</label>
                    <input type="text" value="{{ $member->join_date ?? '' }}"
                        class="form-input w-full bg-slate-100 cursor-not-allowed" disabled>
                    <p class="text-slate-400 text-xs mt-1">System generated</p>
                </div>

                <div></div>

                <div class="md:col-span-2">
                    <p class="text-sm font-semibold text-slate-700 mb-4 border-t pt-4">Change Password <span
                            class="text-slate-400 font-normal">(optional)</span></p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">New Password</label>
                    <input type="password" name="password" class="form-input w-full">
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-input w-full">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Current Password
                        <span class="text-slate-400 font-normal">(required only when changing email or password)</span>
                    </label>
                    <input type="password" name="current_password" class="form-input w-full md:w-1/2">
                    @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">Update
                    Profile</button>
                <a href="{{ route('dashboard') }}"
                    class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
@endsection