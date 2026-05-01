<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::latest()->get();
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|in:Basic,Pro,Elite',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        MembershipPlan::create([
            'plan_name' => $request->name,
            'duration_days' => $request->duration,
            'price' => $request->price,
        ]);

        return redirect()->route('plans.index')
            ->with('success', 'Membership plan added successfully.');
    }

    public function edit(MembershipPlan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, MembershipPlan $plan)
    {
        $request->validate([
            'name' => 'required|in:Basic,Pro,Elite|unique:membership_plans,plan_name',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $plan->update([
            'plan_name' => $request->name,
            'duration_days' => $request->duration,
            'price' => $request->price,
        ]);

        return redirect()->route('plans.index')
            ->with('success', 'Membership plan updated successfully.');
    }
}