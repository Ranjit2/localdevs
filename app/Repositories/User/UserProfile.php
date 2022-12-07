<?php 

namespace App\Repositories\User;

use App\Models\User;

class UserProfile {

    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(array $data): void
    {
        $user = $this->user->find(1);
        
        $this->user->where('id', $user->id)->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'about' => $data['about'],
            'availableDays' => implode(",",$data['numberOfDays']),
            'workType' => implode(",",$data['workType']),
            'workPreference' => implode(",",$data['workPreference'])
        ]);

        $user->skills()->sync($data['skills']);
    }

    public function edit()
    {

    }
}