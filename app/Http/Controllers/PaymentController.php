<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Member;
use App\Models\MembershipPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('member');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('member', function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%');
            });
        }

        $payments = $query->latest()->paginate(10)->withQueryString();

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $members = Member::orderBy('full_name')->get();
        $plans = MembershipPlan::orderBy('plan_name')->get();

        return view('payments.create', compact('members', 'plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'payment_date' => 'required|date',
        ]);

        // ✅ Block if member already has an active payment
        $activePayment = Payment::where('member_id', $request->member_id)
            ->where('expiration_date', '>=', now()->toDateString())
            ->first();

        if ($activePayment) {
            return back()->withErrors([
                'member_id' => 'This member already has an active payment until ' .
                    Carbon::parse($activePayment->expiration_date)->format('F d, Y') . '. Cannot add a new payment.',
            ])->withInput();
        }

        $plan = MembershipPlan::findOrFail($request->membership_plan_id);
        $paymentDate = Carbon::parse($request->payment_date);

        // Start expiration from last payment's expiration if exists
        $lastPayment = Payment::where('member_id', $request->member_id)
            ->latest('payment_date')
            ->first();

        $startDate = $lastPayment && $lastPayment->expiration_date
            ? Carbon::parse($lastPayment->expiration_date)
            : $paymentDate;

        Payment::create([
            'member_id' => $request->member_id,
            'membership_plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_date' => $paymentDate,
            'expiration_date' => $startDate->copy()->addDays($plan->duration_days),
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully!');
    }

    public function show(string $id)
    {
        $payment = Payment::with('member')->findOrFail($id);

        return view('payments.show', compact('payment'));
    }

    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        $members = Member::orderBy('full_name')->get();
        $plans = MembershipPlan::all();

        return view('payments.edit', compact('payment', 'members', 'plans'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'payment_date' => 'required|date',
        ]);

        $payment = Payment::findOrFail($id);
        $plan = MembershipPlan::findOrFail($request->membership_plan_id);

        $paymentDate = Carbon::parse($request->payment_date);

        $payment->update([
            'member_id' => $request->member_id,
            'membership_plan_id' => $request->membership_plan_id,
            'amount' => $plan->price,
            'payment_date' => $paymentDate,
            'expiration_date' => $paymentDate->copy()->addDays($plan->duration_days),
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully!');
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully!');
    }
}