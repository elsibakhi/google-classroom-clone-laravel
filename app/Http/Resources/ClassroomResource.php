<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
   

        return [
            "name"=>$this->name,
            "meta"=>[
            "subject"=>$this->subject,
            "room"=>$this->room,
            "section"=>$this->section,
            "theme"=>$this->theme,
            ],
            "status"=>$this->status,
            "cover_img"=>$this->cover_img_url,
            "user"=>[
             "name" =>$this->user->name,

            ],
            ];
    }
}
