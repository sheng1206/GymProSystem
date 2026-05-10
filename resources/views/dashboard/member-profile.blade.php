@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">My Profile</h3>
                    <p class="text-sm text-gray-500 mt-1">Your personal gym information</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition">
                    <i data-lucide="square-pen" class="w-4 h-4"></i>
                    Edit Profile Info
                </a>
            </div>

            @if($member)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Full Name</p>
                        <p class="font-semibold text-slate-800">{{ $member->full_name }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Contact</p>
                        <p class="font-semibold text-slate-800">{{ $member->contact }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Join Date</p>
                        <p class="font-semibold text-slate-800">{{ $member->join_date }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Membership Plan</p>
                        <p class="font-semibold text-slate-800">{{ $member->membershipPlan->plan_name ?? 'No Plan' }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Assigned Trainer</p>
                        <p class="font-semibold text-slate-800">{{ $trainer->name ?? 'No Trainer' }}</p>
                    </div>
                </div>
            @else
                <p class="text-slate-500">No member profile found.</p>
            @endif
        </div>
    </div>
@endsection