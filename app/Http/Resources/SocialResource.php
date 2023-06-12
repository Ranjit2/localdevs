<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return [
        //     'twitter' => $this->twitter,
        //     'website' => $this->website ,
        //     'dribbble' => $this->dribbble,
        //     'behance' => $this->behance,
        //     'linkedin' => $this->linkedin,
        //     'github' => $this->github
        // ];
    }
}
