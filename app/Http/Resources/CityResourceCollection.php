<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CityResourceCollection extends ResourceCollection
{


    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    // public $collects = CityResource::class; // muts type of resource

    // public static $wrap = 'Items'; // you can edit name collection from data to >>

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'cities' => $this->collection,
            'hacker' => 'Yahya Al Hacker'
        ];
    }
}
