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

    public function listSkills(): Response
    {
        $skillListsArrayForProgramming = [];
        $skillListsArrayForFrameworks = [];
        $userExpertise = 'developer'; //auth()->user->expertise;

        $skillListsProgramming =  $this->skill::whereRaw('JSON_CONTAINS(`expertises`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'programming')
            ->get();

        $skillListsFramework =  $this->skill::whereRaw('JSON_CONTAINS(`expertises`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'framework')
            ->get();

        foreach ($skillListsProgramming as $skillList) {
            $skillListsArrayForProgramming[] = $skillList->name;
        }

        foreach ($skillListsFramework as $skillList) {
            $skillListsArrayForFrameworks[] = $skillList->name;
        }

        return response()->json([
            'programming' => $skillListsArrayForProgramming,
            'framework' => $skillListsArrayForFrameworks
        ]);
    }
}
