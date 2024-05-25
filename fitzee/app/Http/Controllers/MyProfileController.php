<?php
namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MyProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        return Inertia::render('Profile', [
            'profile' => $profile,
            'programOptions' => Profile::getProgramOptions(),
            'genderOptions' => Profile::getGenderOptions(),
            'goalOptions' => Profile::getGoalOptions(),
            'gymFrequentationOptions' => Profile::getGymFrequentationOptions(),
            'programSpecifics' => Profile::getProgramSpecifics(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'age' => 'max:255|nullable',
            'gender' => 'nullable|in:' . implode(',', Profile::getGenderValues()),
            'weight' => 'max:255|nullable',
            'weight_goal' => 'max:255|nullable',
            'size' => 'max:255|nullable',
            'gym_experience' => 'max:255|nullable',
            'gym_frequentation' => 'max:255|nullable|in:' . implode(',', Profile::getGymFrequentationValues()),
            'program_type' => 'nullable|in:' . implode(',', Profile::getProgramTypeValues()),
            'goal' => 'max:255|nullable',
            'goal_date' => 'max:255|nullable',
        ]);

        $user = Auth::user();
        $profile = Profile::firstOrNew(['user_id' => $user->id]);

        $profile->fill($data);
        $profile->save();

        return Inertia::render('Profile')->with('success', 'Profile successfully edited !');
    }
}
