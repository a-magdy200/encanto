<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ['user name' => $this->user->name
            , 'email'=>$this->user->email,
            'training session name' => $this->training_session->name,
            'gym'=>"5555",'city'=>"5555"];
}}
