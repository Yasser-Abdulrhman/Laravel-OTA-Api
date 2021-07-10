<?php

namespace App\Http\Resources\places;

use Illuminate\Http\Resources\Json\JsonResource;

class Place extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static $wrap = 'place';

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [           
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'image' => $this->image,
            'price' => $this->price,
            'offer' => $this->offer,
            'admin_id' => $this->admin_id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
      
    }
}
