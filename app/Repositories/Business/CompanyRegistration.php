<?php 

namespace App\Repositories\Business;
use App\Models\User;

class CompanyRegistration 
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(array $data)
    {
        
    }
}