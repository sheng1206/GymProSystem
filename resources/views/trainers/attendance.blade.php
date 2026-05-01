@foreach($attendances as $attendance)
    <div class="p-3 border rounded">
        <p>
            {{ $attendance->member->full_name ?? 'N/A' }}
        </p>

        <p>
            Check-in:
            {{ $attendance->check_in }}
        </p>
    </div>
@endforeach