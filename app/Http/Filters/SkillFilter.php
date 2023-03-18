<?php 

namespace App\Http\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class SkillFilter extends Filter
{
    public function handle(Builder $query, Closure $next)
    {
        if (array_key_exists('skill', $this->request->filters) && $this->request->filters['skill']) {
            $query->join('skill_user', 'skill_user.user_id', '=', 'users.id')
                ->select('users.*')
                ->whereIn('skill_user.skill_id', $query['skill'])
                ->groupBy('users.id');
        }

        return $next($query);
    }
}
