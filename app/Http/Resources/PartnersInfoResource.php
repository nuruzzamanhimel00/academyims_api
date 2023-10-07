<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnersInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'partner_name' => $this->partner_name,
            'partner_type' => $this->partner_type,
            'partner_code' => $this->partner_code,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'upazila_thana' => $this->upazila_thana,
            'District' => $this->District,
            'division' => $this->division,
            'signature' => $this->signature,
        ];

    }
}
