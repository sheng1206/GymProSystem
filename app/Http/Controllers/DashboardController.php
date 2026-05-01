<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Trainer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // =====================
        // ADMIN DASHBOARD
        // =====================
        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                'totalMembers' => Member::count(),
                'totalTrainers' => Trainer::count(),
                'totalRevenue' => Payment::sum('amount'),

                // FIXED COLUMN
                'todayAttendance' => Attendance::whereDate('check_in', today())->count(),

                'recentPayments' => Payment::with('member')->latest()->take(5)->get(),
                'recentMembers' => Member::latest()->take(5)->get(),
            ]);
        }

        // =====================
        // STAFF DASHBOARD
        // =====================
        if ($user->role === 'staff') {
            return view('dashboard.staff', [
                'totalMembers' => Member::count(),

                // FIXED COLUMN
                'todayAttendance' => Attendance::whereDate('check_in', today())->count(),

                'recentMembers' => Member::latest()->take(5)->get(),
            ]);
        }

        // =====================
        // TRAINER DASHBOARD
        // =====================
        if ($user->role === 'trainer') {

            $trainer = $user->trainer;

            $members = $trainer
                ? $trainer->members()->with(['membershipPlan', 'payments'])->get()
                : collect();

            // FIXED COLUMN
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

        // =====================
        // MEMBER DASHBOARD
        // =====================
        if ($user->role === 'member') {

            $member = Member::with([
                'membershipPlan',
                'payments',
                'attendances',
                'trainers'
            ])->where('user_id', $user->id)->first();

            return view('dashboard.member', [
                'member' => $member,
                'payments' => $member?->payments ?? collect(),
                'attendances' => $member?->attendances ?? collect(),
                'trainer' => $member?->trainers->first(),
            ]);
        }
    }
}