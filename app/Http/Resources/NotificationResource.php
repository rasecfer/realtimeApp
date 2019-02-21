<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        Carbon::setLocale('es');
        return [
            'id' => $this->id,
            'replyBy' => $this->data['replyBy'],
            'question' => $this->data['question'],
            'path' => $this->data['path'],
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
