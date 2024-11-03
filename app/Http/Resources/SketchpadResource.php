<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SketchpadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'type' => 'sketchpads',
            'id' => (string) $this->id,
            'attributes' => [
                'FIO' => $this->FIO,
                'company' => $this->company,
                'telephone' => $this->telephone,
                'email' => $this->email,
                'date_of_birth' => $this->date_of_birth,
                'photo' => $this->photo,
            ],
            'links' => [
                'self' => route('sketchpads.show', ['sketchpad' => $this->id]),
            ],
        ];
    }
}
