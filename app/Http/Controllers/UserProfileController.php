<?php

namespace App\Http\Controllers;

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
        $user = \App\Models\User::where('id', 1)->first();
        $details = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'about' => $user->about,
            'numberOfDays' => $user->numberOfDays,
            'workType' => $user->workType
        ];

        return $details;

    }
}
