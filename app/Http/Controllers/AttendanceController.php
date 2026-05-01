<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Member;

class AttendanceController extends Controller
{
    /**
     * Display attendance page
     */
    public function index()
    {
        $attendances = Attendance::with('member')->latest()->get();
        $members = Member::all();

        return view('attendance.index', compact('attendances', 'members'));
    }

    public function create()
    {
        $members = Member::orderBy('full_name')->get();

        return view('attendance.create', compact('members'));
    }

    /**
     * Store new attendance (Check In)
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
        ]);

        // prevent double check-in if member still has no check out yet
        $existingAttendance = Attendance::where('member_id', $request->member_id)
            ->whereNull('check_out')
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'This member is already checked in.');
        }

        Attendance::create([
            'member_id' => $request->member_id,
            'check_in' => now(),
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Member checked in successfully!');
    }

    public function show($id)
    {
        $attendance = \App\Models\Attendance::with('member')->findOrFail($id);

        return view('attendance.show', compact('attendance'));
    }
    /**
     * Update attendance (Check Out)
     */
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->update([
            'check_out' => now(),
        ]);

        return redirect()->back()->with('success', 'Member checked out successfully!');
    }

    /**
     * Remove attendance record
     */
    public function destroy($id)
    {
        $attendance = \App\Models\Attendance::findOrFail($id);

        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}