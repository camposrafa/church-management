<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MemberCollection extends ResourceCollection
{
    /**
     * @var array
     */
    protected $summary = null;

    public function __construct($resource, $summary = null)
    {
        parent::__construct($resource);
        $this->summary = $summary;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (!empty($this->summary)) {
            return [
                'data' => $this->collection,
                'summary' => $this->summary,
            ];
        } else {
            return parent::toArray($request);
        }
    }
}
