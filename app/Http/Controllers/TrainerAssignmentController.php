<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerAssignment;
use App\Models\Member;
use App\Models\Trainer;


class TrainerAssignmentController extends Controller
{
    /**
     * Display list of trainer assignments
     */
    public function index()
    {
        $assignments = TrainerAssignment::with(['member', 'trainer'])
            ->latest()
            ->get();

        return view('trainer-assignments.index', compact('assignments'));
    }
    public function show($id)
    {
        $assignment = \App\Models\TrainerAssignment::with(['member', 'trainer'])->findOrFail($id);

        return view('trainer-assignments.show', compact('assignment'));
    }
    /**
     * Show assign trainer form
     */
    public function create()
    {
        $members = Member::orderBy('full_name')->get();
        $trainers = Trainer::orderBy('name')->get();

        return view('trainer-assignments.create', compact('members', 'trainers'));
    }

    /**
     * Save trainer assignment
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainer_id' => 'required|exists:trainers,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        TrainerAssignment::create([
            'member_id' => $request->member_id,
            'trainer_id' => $request->trainer_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()
            ->route('trainer-assignments.index')
            ->with('success', 'Trainer assigned successfully.');
    }
}