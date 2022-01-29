<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class State extends JsonResource
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
            'code' => $this->code,
            'abbreviation' => $this->abbreviation,
            'name' => $this->name,
            'lat' => $this->lat,
            'long' => $this->long,
        ];
    }
}
