@extends('layouts.app')

@section('title', 'Assign Trainer')
@section('page-title', 'Assign Trainer')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Assign Trainer</h2>
                <p class="text-sm text-gray-500">Search a member below, then assign a trainer.</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('trainer-assignments.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Search Member --}}
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Search Member
                    </label>

                    <input type="text" id="searchMember" placeholder="Type member name..." autocomplete="off"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">

                    <div id="searchResults"
                        class="absolute left-0 right-0 bg-white border border-gray-200 rounded-xl mt-1 shadow-lg hidden z-50 max-h-44 overflow-y-auto">
                    </div>
                </div>

                {{-- Member Dropdown --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Member</label>

                    <select name="member_id" id="memberSelect"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Member</option>

                        @foreach ($members as $member)
                            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->full_name ?? $member->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Trainer Dropdown --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trainer</label>

                    <select name="trainer_id"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Trainer</option>

                        @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ old('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->name }} - {{ $trainer->specialization }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Start Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>

                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- End Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>

                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="px-5 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                        Assign Trainer
                    </button>

                    <a href="{{ route('trainer-assignments.index') }}"
                        class="px-5 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>

    <script>
        const members = @json(
            $members->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->full_name ?? $member->name,
                ];
            })->values()
        );

        const searchInput = document.getElementById('searchMember');
        const resultsBox = document.getElementById('searchResults');
        const memberSelect = document.getElementById('memberSelect');

        searchInput.addEventListener('keyup', function () {
            const keyword = this.value.toLowerCase().trim();

            resultsBox.innerHTML = '';

            if (keyword === '') {
                resultsBox.classList.add('hidden');
                return;
            }

            const filteredMembers = members.filter(member =>
                member.name.toLowerCase().includes(keyword)
            );

            if (filteredMembers.length === 0) {
                resultsBox.innerHTML = `
                    <div class="px-4 py-3 text-sm text-gray-500">
                        Nothing found
                    </div>
                `;
            } else {
                filteredMembers.forEach(member => {
                    const item = document.createElement('div');

                    item.className = 'px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 cursor-pointer';
                    item.textContent = member.name;

                    item.addEventListener('click', function () {
                        searchInput.value = member.name;
                        memberSelect.value = member.id;
                        resultsBox.classList.add('hidden');
                    });

                    resultsBox.appendChild(item);
                });
            }

            resultsBox.classList.remove('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!searchInput.contains(event.target) && !resultsBox.contains(event.target)) {
                resultsBox.classList.add('hidden');
            }
        });
    </script>
@endsection