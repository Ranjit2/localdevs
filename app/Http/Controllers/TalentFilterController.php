<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class TalentFilterController extends Controller
{

    public function user()
    {
        return $users = User::paginate(1);
    }

    public function index(Request $request)
    {
        $query = $request->filters;

        $sql = User::with('skills');

            if (array_key_exists('dev', $query) && $query['dev']) {
                $sql->where('expertise', $query['dev']);
            }

            if (array_key_exists('preference', $query) && $query['preference']) {
                $sql->where(function($queryBuilder) use ($query) {
                    $queryBuilder->whereIn('workPreference', $query['preference'])
                        ->orWhere('workPreference', 'onsite,wfh');
                });
            }

            if (array_key_exists('experience', $query) && $query['experience']) {
                $arrayNumber = explode('-', $query['experience']);
                $firstValue = $arrayNumber[0];
                $secondValue = $arrayNumber[1];
                //two digit numbers are considered as string, so convert to int with intval
                $sql->whereBetween('experience', [$firstValue, intval($secondValue)]);
            }

            if (array_key_exists('place', $query) && $query['place']) {
                $sql->join('place_user', 'place_user.user_id', '=', 'users.id')
                    ->select('users.*')
                    ->whereIn('place_user.place_id', $query['place'])
                    ->groupBy('users.id');
            }

            if (array_key_exists('skill', $query) && $query['skill']) {

                $sql->join('skill_user', 'skill_user.user_id', '=', 'users.id')
                    ->select('users.*')
                    ->whereIn('skill_user.skill_id', $query['skill'])
                    ->groupBy('users.id');
            }

        return $sql->paginate(5);
    }

    public function view(User $user,$slug) 
    {
        $user = $user->where('slug', $slug)->first();
        $user = $user->load('skills');
        return view('user-profile', compact('user'));
    }

    public function skills()
    {
        return Skill::get();
    }

    public function design()
    {
        return view('design');
    }

    public function register()
    {
        return view('talent.register');
    }
}
