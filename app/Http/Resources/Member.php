<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Member extends JsonResource
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
            'picture' =>  new File($this->picture),
            'birth_date' => $this->birth_date,
            'occupations' => $this->occupations,
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'address' => $this->address,
            'neighborhood' => $this->neighborhood,
            'email' => $this->email,
            'number' => $this->number,
            'postal_code' => $this->postal_code,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'spouse' => $this->spouse,
            'wedding_date' => $this->wedding_date,
            'qtty_sons' => $this->qtty_sons,
            'civil_state_id' => $this->civilState,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
