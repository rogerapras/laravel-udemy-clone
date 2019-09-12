<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'image' => $this->image,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'sortOrder' => $this->sortOrder,
            'live' => $this->live,
            'total_courses' => $this->course_count,
            'children' => CategoryResource::collection($this->whenLoaded('children'))
        ];
    }
}
