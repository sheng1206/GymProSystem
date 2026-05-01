<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display all members with search and pagination.
     */
    public function index(Request $request)
    {
        $query = Member::with('membershipPlan');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('contact', 'like', "%{$search}%");
            });
        }

        $members = $query->latest()->paginate(10)->withQueryString();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        $membershipPlans = MembershipPlan::orderBy('plan_name')->get();

        return view('members.create', compact('membershipPlans'));
    }

    /**
     * Store a newly created member.
     */


    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'join_date' => 'required|date',
            'payment_date' => 'required|date',
        ]);

        // Create member
        $member = Member::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'contact' => $request->contact,
            'membership_plan_id' => $request->membership_plan_id,
            'join_date' => $request->join_date,
        ]);

        // Get plan
        $plan = MembershipPlan::findOrFail($request->membership_plan_id);

        $paymentDate = Carbon::parse($request->payment_date);

        // Create ONE payment only
        Payment::create([
            'member_id' => $member->id,
            'membership_plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_date' => $paymentDate,
            'expiration_date' => $paymentDate->copy()->addDays($plan->duration_days),
        ]);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member added and payment recorded successfully!');
    }

    /**
     * Display a specific member.
     */
    public function show(string $id)
    {
        $member = Member::with([
            'membershipPlan',
            'payments' => function ($query) {
                $query->latest('payment_date');
            },
            'attendances' => function ($query) {
                $query->latest('check_in');
            },
        ])->findOrFail($id);

        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing a member.
     */
    public function edit(string $id)
    {
        $member = Member::findOrFail($id);
        $membershipPlans = MembershipPlan::orderBy('plan_name')->get();

        return view('members.edit', compact('member', 'membershipPlans'));
    }

    /**
     * Update the specified member.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'join_date' => 'required|date',
        ]);

        $member = Member::findOrFail($id);

        $member->update([
            'full_name' => $request->full_name,
            'contact' => $request->contact,
            'membership_plan_id' => $request->membership_plan_id,
            'join_date' => $request->join_date,
        ]);

        $plan = MembershipPlan::findOrFail($request->membership_plan_id);

        $latestPayment = Payment::where('member_id', $member->id)
            ->latest('payment_date')
            ->first();

        if ($latestPayment) {
            $baseDate = $latestPayment->payment_date
                ? Carbon::parse($latestPayment->payment_date)
                : Carbon::parse($request->join_date);

            $latestPayment->update([
                'membership_plan_id' => $plan->id,
                'amount' => $plan->price,
                'expiration_date' => $baseDate->copy()->addDays($plan->duration_days),
            ]);
        }

        return redirect()
            ->route('members.index')
            ->with('success', 'Member updated successfully!');
    }

    /**
     * Remove the specified member.
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('success', 'Member deleted successfully!');
    }
}