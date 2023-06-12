<?php

namespace App\Http\Controllers;

use App\Models\AdditionalSkills;
use App\Models\Employment;
use App\Models\Place;
use App\Models\User;
use App\Repositories\User\SkillLists;
use App\Repositories\User\UserProfile;
use Illuminate\Http\JsonResponse;
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

    public function additionalSkills(Request $request)
    {
        $additionalSkills = AdditionalSkills::create([
            'user_id' => auth()->user()->id,
            'name' => $request->additionalSkill
        ]);

        return response()->json([
            'message' => 'Skill added successfully',
            'data' => $additionalSkills
        ]);
    }

    public function getAdditionalSkills() 
    {
        return response()->json([
            'message' => 'Additional skills',
            'data' => AdditionalSkills::where('user_id', auth()->user()->id)
            ->select('id','name')
            ->get()
        ]); 
    }

    public function deleteAdditionalSkills(Request $request)
    {
        AdditionalSkills::find($request->id)->delete();
    }

    public function findSkillListsForloggedInUser()
    {
        return $this->skillLists->listSkills();
    }

    public function userDetails()
    {
        return $this->userProfile->getUserDetails();
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

        return $this->userProfile->updateProfileImage($request);

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
        $this->userProfile->updateUserEducation($request->education);

        return response()->json('success', Response::HTTP_OK);
    }

    public function social(Request $request)
    {
        $this->userProfile->storeSocial($request->formData);

        return response()->json(['message' => 'Social links updated successfully']);
    }

    public function getSocial() 
    {
        return $this->userProfile->getSocialUrls();
    }

    public function employment(Request $request)
    {
       // dd($request->formData);
        return Employment::updateOrCreate(
            ['id' => $request->formData['jobId'], 'user_id'=> auth()->user()->id],
            [
                'job_title' => $request->formData['jobTitle'],
                'company_name' => $request->formData['companyName'],
                'company_location' => $request->formData['companyLocation'],
                'start_date' => $request->formData['startDate'],
                'end_date' => $request->formData['endDate'],
                'isWorking' => $request->formData['isWorking']?? 0,
                'description' => $request->formData['description'],
        ]
    );
    }

    public function getEmploymentHistory()
    {
        return Employment::latest()->where('user_id', auth()->user()->id)
            ->get()
            ->makeHidden(['user_id']);
    }

    public function deleteEmploymentHistory(Request $request)
    {
        return Employment::where('id', $request->jobId)->delete();
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
