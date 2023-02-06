<?php

namespace App\Repositories\User;

use App\Models\Skill;
use Symfony\Component\HttpFoundation\Response;

class SkillLists
{

    protected $skill;

    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }

    //this list the skills based on user expeeertise. if user is a developer show only developer skills.
    public function listSkills(): Response
    {
        $skillListsArrayForProgramming = [];
        $skillListsArrayForFrameworks = [];
        $skillListsArrayForMotion = [];
        $userExpertise = auth()->user()->expertise; //auth()->user->expertise;

        //need to change backend to developer, frontend to designer in users 
        $skillListsProgramming =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'programming')
            ->get();

        $skillListsFramework =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'framework')
            ->get();
        
        $skillListsMotion =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
        ->where('category', 'graphics')
        ->get();

        //video editing category for motion

        foreach ($skillListsProgramming as $skillList) {
            $skillListsArrayForProgramming[$skillList->id] = $skillList->name;
        }

        foreach ($skillListsFramework as $skillList) {
            $skillListsArrayForFrameworks[$skillList->id] = $skillList->name;
        }

        foreach ($skillListsMotion as $skillList) {
            $skillListsArrayForMotion[$skillList->id] = $skillList->name;
        }

        return response()->json([
            'programming' => $skillListsArrayForProgramming,
            'framework' => $skillListsArrayForFrameworks,
            'motion' => $skillListsArrayForMotion,
        ]);
    }
}
