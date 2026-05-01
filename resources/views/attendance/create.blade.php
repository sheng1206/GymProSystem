@extends('layouts.app')

@section('title', 'Record Attendance')
@section('page-title', 'Record Attendance')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('attendance.index') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Record Attendance</h2>
                <p class="text-sm text-slate-500 mt-1">Search and select a member to record attendance.</p>
            </div>

            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-xl bg-green-100 text-green-700 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 px-4 py-3 rounded-xl bg-red-100 text-red-700 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('attendance.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- SEARCH MEMBER -->
                <div class="relative">
                    <label for="memberSearch" class="block text-sm font-medium text-slate-700 mb-2">
                        Search Member
                    </label>

                    <input type="text" id="memberSearch" placeholder="Search member..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        autocomplete="off">

                    <div id="searchResults"
                        class="absolute z-10 w-full bg-white border border-slate-200 rounded-xl mt-1 shadow hidden max-h-60 overflow-y-auto">
                    </div>
                </div>

                <!-- MEMBER -->
                <div>
                    <label for="member_id" class="block text-sm font-medium text-slate-700 mb-2">
                        Member *
                    </label>

                    <select name="member_id" id="member_id"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">Select Member</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="border-t pt-4 flex justify-end gap-3">
                    <a href="{{ route('attendance.index') }}"
                        class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium transition">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-800 text-white font-medium transition">
                        Save Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const members = @json($members);
        const searchInput = document.getElementById('memberSearch');
        const resultsBox = document.getElementById('searchResults');
        const memberSelect = document.getElementById('member_id');

        function renderResults(filtered) {
            resultsBox.innerHTML = '';

            if (filtered.length === 0) {
                resultsBox.innerHTML = `
                    <div class="px-4 py-3 text-sm text-slate-400">
                        Nothing found
                    </div>
                `;
                resultsBox.classList.remove('hidden');
                return;
            }

            filtered.forEach(member => {
                const item = document.createElement('div');
                item.className = "px-4 py-3 hover:bg-slate-100 cursor-pointer text-sm text-slate-700";
                item.textContent = member.full_name;

                item.addEventListener('click', function () {
                    searchInput.value = member.full_name;
                    memberSelect.value = member.id;
                    resultsBox.classList.add('hidden');
                });

                resultsBox.appendChild(item);
            });

            resultsBox.classList.remove('hidden');
        }

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            memberSelect.value = '';

            if (query === '') {
                resultsBox.classList.add('hidden');
                resultsBox.innerHTML = '';
                return;
            }

            const exactMatch = members.find(member =>
                member.full_name.toLowerCase() === query
            );

            if (exactMatch) {
                searchInput.value = exactMatch.full_name;
                memberSelect.value = exactMatch.id;
                resultsBox.classList.add('hidden');
                resultsBox.innerHTML = '';
                return;
            }

            const filtered = members.filter(member =>
                member.full_name.toLowerCase().includes(query)
            );

            renderResults(filtered);
        });

        memberSelect.addEventListener('change', function () {
            const selected = members.find(member => member.id == this.value);
            if (selected) {
                searchInput.value = selected.full_name;
            } else {
                searchInput.value = '';
            }
        });

        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.classList.add('hidden');
            }
        });

        window.addEventListener('load', function () {
            const selected = members.find(member => member.id == memberSelect.value);
            if (selected) {
                searchInput.value = selected.full_name;
            }
        });
    </script>
@endsection