<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Trainer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // =====================
    // MAIN DASHBOARD
    // =====================
    public function index()
    {
        $user = auth()->user();

        // ADMIN
        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                'totalMembers' => Member::count(),
                'totalTrainers' => Trainer::count(),
                'totalRevenue' => Payment::sum('amount'),
                'todayAttendance' => Attendance::whereDate('check_in', today())->count(),
                'recentPayments' => Payment::with('member')->latest()->take(5)->get(),
                'recentMembers' => Member::latest()->take(5)->get(),
            ]);
        }

        // STAFF
        if ($user->role === 'staff') {
            return view('dashboard.staff', [
                'totalMembers' => Member::count(),
                'todayAttendance' => Attendance::whereDate('check_in', today())->count(),
                'recentMembers' => Member::latest()->take(5)->get(),
            ]);
        }

        // TRAINER
        if ($user->role === 'trainer') {
            $trainer = $user->trainer;

            $members = $trainer
                ? $trainer->members()->with(['membershipPlan', 'payments'])->get()
                : collect();

            $todayAttendance = Attendance::whereIn('member_id', $members->pluck('id'))
                ->whereDate('check_in', today())
                ->count();

            $activeMembers = $members->filter(function ($member) {
                $latestPayment = $member->payments->sortByDesc('payment_date')->first();
                return $latestPayment && $latestPayment->expiration_date >= today();
            })->count();

            return view('dashboard.trainer', [
                'trainer' => $trainer,
                'members' => $members,
                'todayAttendance' => $todayAttendance,
                'activeMembers' => $activeMembers,
            ]);
        }

        // MEMBER
        if ($user->role === 'member') {
            $member = Member::with([
                'membershipPlan',
                'payments',
                'attendances',
                'assignments.trainer',
            ])->where('user_id', $user->id)->first();

            $latestAssignment = $member?->assignments->sortByDesc('start_date')->first();

            return view('dashboard.member', [
                'member' => $member,
                'payments' => $member?->payments ?? collect(),
                'attendances' => $member?->attendances ?? collect(),
                'trainer' => $latestAssignment?->trainer,
            ]);
        }
    }

    // =====================
    // MEMBER PROFILE PAGE
    // =====================
    public function profile()
    {
        $user = auth()->user();

        $member = Member::with(['membershipPlan', 'assignments.trainer'])
            ->where('user_id', $user->id)
            ->first();

        $latestAssignment = $member?->assignments->sortByDesc('start_date')->first();
        $trainer = $latestAssignment?->trainer;

        return view('dashboard.member-profile', compact('member', 'trainer'));
    }

    // =====================
    // MEMBER PAYMENTS PAGE
    // =====================
    public function payments()
    {
        $user = auth()->user();

        $member = Member::with('payments')
            ->where('user_id', $user->id)
            ->first();

        $payments = $member?->payments ?? collect();

        return view('dashboard.member-payments', compact('member', 'payments'));
    }

    // ========================
    // MEMBER ATTENDANCE PAGE
    // ========================
    public function attendance()
    {
        $user = auth()->user();

        $member = Member::with('attendances')
            ->where('user_id', $user->id)
            ->first();

        $attendances = $member?->attendances ?? collect();

        return view('dashboard.member-attendance', compact('member', 'attendances'));
    }
}