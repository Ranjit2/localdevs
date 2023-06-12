<?php

namespace App\Repositories\User;

use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserProfile
{

    protected $user;

    protected $social;

    public function __construct(User $user, Social $social)
    {
        $this->user = $user;
        $this->social = $social;
    }

    public function store(array $data)
    {
        // dd($data['userSelectedSkills']);
        // dd(implode(",",$data['workType']));
        $user = $this->user->find(auth()->id());

        //days table to store monday, tues ...sun 
        //pivot table store user_id and days_id 
        //users table has user id 

        //join loggedIn userid and days and look from pivot table and get days 
        // need logic here
        $this->user->where('id', $user->id)->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'about' => $data['about'],
            'roleLevel' => $data['roleLevel'],
            'availableDays' => implode(",", $data['availableDays']),
            'workType' => implode(",", $data['workType']),
            'workPreference' => implode(",", $data['workPreference']),
            'experience' => $data['experience'],
            'address' => $data['search'],
        ]);

        $user->skills()->sync($data['userSelectedSkills']);
        $user->places()->sync(($data['userSelectedPlaces']));
    }

    public function getUserDetails()
    {
        $user = $this->user->where('id', auth()->id())->first();

        $filteredDaysNullValue = array_filter(explode(",", $user->availableDays), fn ($value) => $value !== '');
        $filteredWorkTypeNullValue = array_filter(explode(",", $user->workType), fn ($value) => $value !== '');

        $skillSetIds = [];
        $skillSetNames = [];
        $years = $user->skills()->pluck('year');

        foreach ($user->skills as $skill) {
            $skillSetIds[] = $skill['id'];
            $skillSetNames[] = $skill['name'];
        }

        return [
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
    }

    public function storeSocial(array $formData)
    {
        $this->social->updateOrCreate(
            ['user_id' =>  auth()->user()->id],
            [
                'website' => $formData['website'],
                'github' => $formData['github'],
                'linkedin' => $formData['linkedin'],
                'dribbble' => $formData['dribbble'],
                'behance' => $formData['behance'],
                'twitter' => $formData['twitter']
            ], Response::HTTP_OK
        );
    }

    public function getSocialUrls()
    {
        $user = $this->social->where('user_id', auth()->user()->id)->first();

        return response()->json([
            'twitter' => $user->twitter,
            'website' => $user->website ,
            'dribbble' => $user->dribbble,
            'behance' => $user->behance,
            'linkedin' => $user->linkedin,
            'github' => $user->github
        ], Response::HTTP_OK);
    }

    public function updateUserEducation(string $education)
    {
        return $this->user->where('id', auth()->id())->update(['education' => $education]);
    }

    public function updateProfileImage(Request $request): JsonResponse
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->hashName();

            // Resize the image to a maximum width of 800 pixels
            $img = Image::make($image->getRealPath())->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Upload the resized image to S3, images folder in S3
            $path = 'images/' . $filename;
            Storage::disk('s3')->put($path, $img->stream()->__toString());

            // Update the user's profile image URL with the S3 object URL
            User::where('id', auth()->id())->update([
                'profileImage' =>  $awsPath = Storage::disk('s3')->url($path)
            ]);

            return response()->json(['url' => $awsPath], Response::HTTP_OK);
        }
    }

    public function edit()
    {
    }
}
