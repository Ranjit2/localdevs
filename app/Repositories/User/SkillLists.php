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
        $skillListsArrayForDB = [];
        $skillListsArrayForCloudComputing = [];
        $userExpertise = auth()->user()->expertise;

        //need to change backend to developer, frontend to designer in users 
        $skillListsProgramming =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'programming')
            ->orderBy('name', 'asc')
            ->get();

        $skillListsFramework =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'frameworks')
            ->get();

        $skillListsMotion =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'motion')
            ->get();

        $skillListsDB =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'database')
            ->get();

        $skillListsCloudComputing =  $this->skill::whereRaw('JSON_CONTAINS(`expertise`, \'{"' . $userExpertise . '":1}\')')
            ->where('category', 'cloud computing')
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

        foreach ($skillListsDB as $skillList) {
            $skillListsArrayForDB[$skillList->id] = $skillList->name;
        }

        foreach ($skillListsCloudComputing as $skillList) {
            $skillListsArrayForCloudComputing[$skillList->id] = $skillList->name;
        }
        //skills table is made by admin 

        $responseData = [];
        // this way we are not sending keys like programming,framework etc in response and avoiding uncesseary checks in ProfileEdit.vue
        if (!empty($skillListsArrayForProgramming)) {
            $responseData['programming'] = $skillListsArrayForProgramming;
        }

        if (!empty($skillListsArrayForFrameworks)) {
            $responseData['framework'] = $skillListsArrayForFrameworks;
        }

        if (!empty($skillListsArrayForMotion)) {
            $responseData['motion'] = $skillListsArrayForMotion;
        }

        if (!empty($skillListsArrayForDB)) {
            $responseData['database'] = $skillListsArrayForDB;
        }

        if (!empty($skillListsArrayForCloudComputing)) {
            $responseData['cloudcomputing'] = $skillListsArrayForCloudComputing;
        }

        return response()->json($responseData);
    }
}
