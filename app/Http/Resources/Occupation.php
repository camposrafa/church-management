<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Occupation extends JsonResource
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
            'name' => $this->name,
            'desc' => $this->desc,
            'date_consecration' => $this->date_consecration,
            'locale_consecration' => $this->locale_consecration,
            'consecrated_by' => $this->consecrated_by,
            'date_conversion' => $this->date_conversion,
            'locale_conversion' => $this->locale_conversion,
            'date_baptism' => $this->date_baptism,
            'locale_baptism' => $this->locale_baptism,
            'date_admission' => $this->date_admission,
            'admission_by' => $this->admission_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
