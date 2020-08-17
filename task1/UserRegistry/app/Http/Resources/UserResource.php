<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'position' => $this->position,
            'created_at' => ($this->created_at) ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : '',
            'updated_at' => ($this->updated_at) ? Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') : ''
        ];
    }
}
