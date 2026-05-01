<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\User;
use App\Models\Attendance;
use App\Models\TrainerAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::latest()->paginate(10);

        return view('trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|in:Basic,Pro,Elite',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('trainers', 'public');
        }


        Trainer::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'specialization' => $request->specialization,
            'photo' => $photoPath,
        ]);

        return redirect()
            ->route('trainers.index')
            ->with('success', 'Trainer added successfully!');
    }
    public function show(string $id)
    {
        $trainer = Trainer::findOrFail($id);

        return view('trainers.show', compact('trainer'));
    }

    public function edit(string $id)
    {
        $trainer = Trainer::findOrFail($id);

        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|in:Basic,Pro,Elite',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $trainer = Trainer::findOrFail($id);

        $photoPath = $trainer->photo;

        if ($request->hasFile('photo')) {
            if ($trainer->photo && Storage::disk('public')->exists($trainer->photo)) {
                Storage::disk('public')->delete($trainer->photo);
            }

            $photoPath = $request->file('photo')->store('trainers', 'public');
        }

        $trainer->update([
            'name' => $request->name,
            'specialization' => $request->specialization,
            'photo' => $photoPath,
        ]);

        return redirect()
            ->route('trainers.index')
            ->with('success', 'Trainer updated successfully.');
    }

    public function destroy(string $id)
    {
        $trainer = Trainer::findOrFail($id);

        if ($trainer->photo && Storage::disk('public')->exists($trainer->photo)) {
            Storage::disk('public')->delete($trainer->photo);
        }

        $trainer->delete();

        return redirect()
            ->route('trainers.index')
            ->with('success', 'Trainer deleted successfully.');
    }

    public function members()
    {
        $trainer = auth()->user()->trainer;

        $assignedMembers = $trainer
            ? $trainer->assignments()->with(['member.membershipPlan', 'member.payments'])->get()
            : collect();

        return view('trainer.members', compact('assignedMembers', 'trainer'));
    }

    public function profile()
    {
        $trainer = auth()->user()->trainer;

        return view('trainer.profile', compact('trainer'));
    }

    public function attendance()
    {
        $trainer = auth()->user()->trainer;

        $attendances = Attendance::with('member')
            ->whereHas('member.assignments', function ($query) use ($trainer) {
                $query->where('trainer_id', $trainer->id);
            })
            ->latest()
            ->get();

        return view('trainer.attendance', compact('attendances'));
    }

    public function payments()
    {
        abort(403, 'Unauthorized');
    }
}