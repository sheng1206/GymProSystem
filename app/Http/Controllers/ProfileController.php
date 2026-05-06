<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\MembershipPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $member = $user->member;
        $membershipPlans = MembershipPlan::all();

        return view('profile.edit', [
            'user' => $user,
            'member' => $member,
            'membershipPlans' => $membershipPlans,
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        if ($user->member) {
            $user->member->update([
                'full_name' => $request->full_name,
                'contact' => $request->contact,
                'join_date' => $request->join_date,
                'membership_plan_id' => $request->membership_plan_id,
            ]);

            $user->update([
                'name' => $request->full_name,
            ]);
        }

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}