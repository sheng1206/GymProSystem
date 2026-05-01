<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\Trainer;
use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\Trainer_Assignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GymSeeder extends Seeder
{
    public function run(): void
    {
        // Plans
        $basic = MembershipPlan::create(['plan_name' => 'Basic', 'duration_days' => 30, 'price' => 999]);
        $pro = MembershipPlan::create(['plan_name' => 'Pro', 'duration_days' => 90, 'price' => 2499]);
        $elite = MembershipPlan::create(['plan_name' => 'Elite', 'duration_days' => 365, 'price' => 7999]);

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Staff
        User::create([
            'name' => 'Staff One',
            'email' => 'staff1@gym.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
        User::create([
            'name' => 'Staff Two',
            'email' => 'staff2@gym.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Trainers
        $trainerData = [
            ['name' => 'Carlos Reyes', 'email' => 'carlos@gym.com', 'spec' => 'Strength & Conditioning'],
            ['name' => 'Maria Santos', 'email' => 'maria@gym.com', 'spec' => 'Yoga & Flexibility'],
            ['name' => 'Jake Mendoza', 'email' => 'jake@gym.com', 'spec' => 'HIIT & Cardio'],
        ];

        $trainers = [];
        foreach ($trainerData as $t) {
            $user = User::create([
                'name' => $t['name'],
                'email' => $t['email'],
                'password' => Hash::make('password'),
                'role' => 'trainer',
            ]);
            $trainers[] = Trainer::create([
                'user_id' => $user->id,
                'name' => $t['name'],
                'specialization' => $t['spec'],
            ]);
        }

        // Members
        $memberData = [
            ['name' => 'Ana Lim', 'email' => 'ana@gym.com', 'plan' => $basic->id],
            ['name' => 'Ben Cruz', 'email' => 'ben@gym.com', 'plan' => $pro->id],
            ['name' => 'Carla Tan', 'email' => 'carla@gym.com', 'plan' => $elite->id],
            ['name' => 'Diego Ramos', 'email' => 'diego@gym.com', 'plan' => $basic->id],
            ['name' => 'Elena Vega', 'email' => 'elena@gym.com', 'plan' => $pro->id],
            ['name' => 'Felix Ong', 'email' => 'felix@gym.com', 'plan' => $elite->id],
            ['name' => 'Grace Lim', 'email' => 'grace@gym.com', 'plan' => $basic->id],
            ['name' => 'Hans Reyes', 'email' => 'hans@gym.com', 'plan' => $pro->id],
            ['name' => 'Iris Bautista', 'email' => 'iris@gym.com', 'plan' => $basic->id],
            ['name' => 'Joel Torres', 'email' => 'joel@gym.com', 'plan' => $elite->id],
        ];

        foreach ($memberData as $i => $m) {
            $user = User::create([
                'name' => $m['name'],
                'email' => $m['email'],
                'password' => Hash::make('password'),
                'role' => 'member',
            ]);

            $member = Member::create([
                'user_id' => $user->id,
                'full_name' => $m['name'],
                'contact' => '09' . rand(100000000, 999999999),
                'membership_plan_id' => $m['plan'],
                'join_date' => now()->subDays(rand(10, 200)),
            ]);

            // Payment
            $plan = MembershipPlan::find($m['plan']);
            Payment::create([
                'member_id' => $member->id,
                'amount' => $plan->price,
                'payment_date' => $member->join_date,
                'expiration_date' => now()->addDays($plan->duration_days),
            ]);

            // Attendance
            for ($j = 0; $j < 5; $j++) {
                $checkIn = now()->subDays(rand(1, 30))->setTime(rand(6, 10), rand(0, 59));
                Attendance::create([
                    'member_id' => $member->id,
                    'check_in' => $checkIn,
                    'check_out' => (clone $checkIn)->addHours(rand(1, 3)),
                ]);
            }

            // Trainer Assignment

            Trainer_Assignment::create([
                'member_id' => $member->id,
                'trainer_id' => $trainers[$i % 3]->id,
                'start_date' => $member->join_date,
                'end_date' => null,
            ]);
        }
    }
}