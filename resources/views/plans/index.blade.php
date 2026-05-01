@extends('layouts.app')

@section('title', 'Membership Plans')
@section('page-title', 'Membership Plans')

@section('content')

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <p class="text-slate-500 text-sm">
                {{ $plans->count() ?? 0 }} plans
            </p>
        </div>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('plans.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-slate-700 hover:bg-slate-800 text-white rounded-lg text-sm font-medium transition">
                + Add Plan
            </a>
        @endif
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        @forelse ($plans as $plan)

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">

                <h3 class="text-lg font-semibold text-slate-800">
                    {{ $plan->plan_name }}
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $plan->duration_days }} days
                </p>

                <p class="text-lg font-bold text-green-600 mt-3">
                    ₱{{ number_format($plan->price, 2) }}
                </p>

                @if(auth()->user()->role === 'admin')
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('plans.edit', $plan->id) }}"
                            class="flex-1 text-center px-4 py-2 bg-slate-700 text-white rounded-lg text-sm hover:bg-slate-800">
                            Edit
                        </a>
                    </div>
                @endif

            </div>

        @empty

            <div class="col-span-full text-center text-slate-400">
                No plans yet
            </div>

        @endforelse

    </div>

@endsection