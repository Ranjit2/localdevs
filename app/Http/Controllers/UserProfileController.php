<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use App\Repositories\User\SkillLists;
use App\Repositories\User\UserProfile;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $skillSet[] = $skill['id'];
        }
        
        $details = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'about' => $user->about,
            'expertise' => $user->expertise,
            'userAddress' => $user->address,
            'experience' => $user->experience,
            'roleLevel' => $user->roleLevel,
            'availableDays' => array_values($filteredDaysNullValue),
            'workType' => array_values($filteredWorkTypeNullValue),
            'skills' => $skillSet,
            'profileImage' => $user->profileImage,
            'workPreference' => explode(',',$user->workPreference), //pass as an array, we can use includes('wfh') in :checked in vuejs 
            'userSelectedPlaces' => $user->places->map(fn($place) => $place['id'])
        ]; 

        return $details;
    }

    public function places()
    {
        return Place::all();
    }

    public function edit() // no need User $user as params
    {
        //we have routekeyName in User model to get based on slug
        //render a view where we can load profileedit componenent from app.js
        return view('profile-edit');
    }

    public function uploadToS3(Request $request)
    {
        $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image')->hashName();
                $path = $request->file('image')->storeAs(
                    'images', //your s3 images folder
                    $file,
                    's3'
                );

                $s3 = Storage::disk('s3');

                User::where('id',auth()->id())->update([
                    'profileImage' => $awsPath = $s3->url($path)
                ]);

                return response()->json($awsPath);

         }
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
