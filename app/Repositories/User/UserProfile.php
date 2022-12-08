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
       // dd(implode(",",$data['workType']));
        $user = $this->user->find(1);
        
        //days table to store monday, tues ...sun 
        //pivot table store user_id and days_id 
        //users table has user id 

        //join loggedIn userid and days and look from pivot table and get days 
        // need logic here

        
        $this->user->where('id', $user->id)->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'about' => $data['about'],
            //'availableDays' => implode(",",$data['numberOfDays']),
            'workType' => implode(",",$data['workType']),
            'workPreference' => implode(",",$data['workPreference'])
        ]);

        $user->skills()->sync($data['skills']);
    }

    public function edit()
    {

    }
}