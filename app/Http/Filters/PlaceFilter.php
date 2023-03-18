<?php 

namespace App\Http\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class PlaceFilter extends Filter
{
    public function handle(Builder $query, Closure $next)
    {
        if (array_key_exists('place', $this->request->filters) && $this->request->filters['place']) {
            $query->join('place_user', 'place_user.user_id', '=', 'users.id')
                ->select('users.*')
                ->whereIn('place_user.place_id', $this->request->filters['place'])
                ->groupBy('users.id');
        }

        return $next($query);
    }
}
