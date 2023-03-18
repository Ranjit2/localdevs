<?php 

namespace App\Repositories\User;

use App\Models\User;

class UserProfile {

    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
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
   //     dd($data['userSelectedPlaces']);
        $this->user->where('id', $user->id)->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'about' => $data['about'],
            'roleLevel' => $data['roleLevel'],
            'availableDays' => implode(",",$data['availableDays']),
            'workType' => implode(",",$data['workType']),
            'workPreference' => implode(",",$data['workPreference']),
            'experience' => $data['experience']
        ]);

        $user->skills()->syncWithoutDetaching($data['userSelectedSkills']);
        $user->places()->syncWithoutDetaching(($data['userSelectedPlaces']));

    }

    public function edit()
    {

    }
}