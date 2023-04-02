<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use App\Repositories\User\SkillLists;
use App\Repositories\User\UserProfile;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

        $skillSetIds = [];
        $skillSetNames = [];
        $years = $user->skills()->pluck('year');

        foreach ($user->skills as $skill) {
            $skillSetIds[] = $skill['id'];
            $skillSetNames[] = $skill['name'];
        }

        $details = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'slug' => $user->slug,
            'address' => $user->address,
            'about' => $user->about,
            'expertise' => $user->expertise,
            'userAddress' => $user->address,
            'experience' => $user->experience,
            'education' => $user->education,
            'roleLevel' => $user->roleLevel,
            'availableDays' => array_values($filteredDaysNullValue),
            'workType' => array_values($filteredWorkTypeNullValue),
            'skills' => $skillSetIds,
            'skillNames' => $skillSetNames,
            'skillYears' => $years,
            'profileImage' => $user->profileImage,
            'workPreference' => explode(',', $user->workPreference), //pass as an array, we can use includes('wfh') in :checked in vuejs 
            'userSelectedPlaces' => $user->places->map(fn ($place) => $place['id'])
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

    public function uploadToS3(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->hashName();

            // Resize the image to a maximum width of 800 pixels
            $img = Image::make($image->getRealPath())->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Upload the resized image to S3
            $path = 'images/' . $filename;
            Storage::disk('s3')->put($path, $img->stream()->__toString());

            // Update the user's profile image URL with the S3 object URL
            User::where('id', auth()->id())->update([
                'profileImage' =>  $awsPath = Storage::disk('s3')->url($path)
            ]);

            return response()->json(['url' => $awsPath], Response::HTTP_OK);
        }
    }

    public function updateExperience(Request $request)
    {
        $user = auth()->user();
        $user->skills()->updateExistingPivot($request->skillId, ['year' => $request->year]);
        $years = $user->skills()->pluck('year');

        return response()->json(['yearOfExperiences' => $years], Response::HTTP_OK);
    }

    public function updateEducation(Request $request)
    {
        $education = User::where('id', auth()->id())->update(['education' => $request->education]);

        return response()->json('success', Response::HTTP_OK);
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
