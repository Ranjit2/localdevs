<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\User\SkillLists;
use App\Repositories\User\UserProfile;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    protected $userProfile;

    protected $skillLists;

    public function __construct(UserProfile $userProfile, SkillLists $skillLists)
    {
        $this->userProfile = $userProfile;
        $this->skillLists = $skillLists;
    }

    public function store(Request $request): Response
    {
        $this->userProfile->store($request->get('formData'));
        return response()->json(['message' => 'Profile updated']);
    }

    public function findSkillListsForloggedInUser()
    {
        return $this->skillLists->listSkills();
    }

    public function userDetails()
    {

        $user = \App\Models\User::where('id', auth()->id())->first();

        $filteredDaysNullValue = array_filter(explode(",", $user->availableDays), fn ($value) => $value !== '');
        $filteredWorkTypeNullValue = array_filter(explode(",", $user->workType), fn ($value) => $value !== '');
        
        $skillSet = [];
        foreach($user->skills as $skill) {
            $skillSet[] = $skill['name'];
        }
        
        $details = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'about' => $user->about,
            'availableDays' => array_values($filteredDaysNullValue),
            'workType' => array_values($filteredWorkTypeNullValue),
            'skills' => $skillSet
        ];

        return $details;
    }

    public function edit(User $user)
    {
        return view('profile-edit', compact('user'));
    }
}
