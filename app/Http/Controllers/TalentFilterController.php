<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class TalentFilterController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->filters;

        $sql = User::with('skills');

        if (array_key_exists('dev', $query) && $query['dev'] ) {
            $sql->where('expertise', $query['dev']);
        }

        if (array_key_exists('preference', $query) && $query['preference']) {
            $sql->where('job_preference', $query['preference']);
        }

        if (array_key_exists('experience', $query) && $query['experience']) {
            $sql->where('experience', $query['experience']);
        }

        if (array_key_exists('place', $query) && $query['place']) {
            $sql->join('place_user', 'place_user.user_id', '=', 'users.id')
                ->select('users.*')
                ->whereIn('place_user.place_id',$query['place'])
                ->groupBy('users.id');
        }

        if (array_key_exists('skill', $query) && $query['skill'] ) {
            
            $sql->join('skill_user', 'skill_user.user_id', '=', 'users.id')
                ->select('users.*')
                ->whereIn('skill_user.skill_id', $query['skill'])
                ->groupBy('users.id');   
        }

        return $sql->get();
        
    }

    public function skills()
    {
        return Skill::get();
    }

    public function design()
    {
        return view('design');
    }
}
