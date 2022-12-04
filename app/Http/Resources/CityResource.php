<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    // /**
    //  * The "data" wrapper that should be applied.
    //  *
    //  * @var string|null
    //  */
    // public static $wrap = 'city'; // you can edit name collection from data to >>

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [ // this you can specify what attributes to show in result
            'identifier' => $this->id, // this word back to request object city
            // 'Engilsh_name' => $this->name_en,
            'Arabic_name' => $this->name_ar,
            $this->mergeWhen(auth('user-api')->user()->hasPermissionTo('Read_Users'), [
                'Engilsh_name' => $this->name_en,
                'users_counter' => 5
            ]),

            // 'users_counter' => $this->when(false,5)  // this to if cond. to something 
            // 'users_counter' => $this->when(auth('user-api')->user()->hasPermissionTo('Read_Cities'),5)  // this to if cond. to something 
        ];

        // when to get result based on condition 
        // mergeWhen to get more one result based on condition
    }
}
