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
        $db_column = ['id','partner_name','partner_type','partner_code','mobile','email','upazila_thana','district','division','signature','signature_url'];
        if(isset($request->select)){
            $make_array = [];
            foreach($request->select as $value){
                if(in_array($value, $db_column)){
                    $make_array[$value] = $this->$value;
                }
            }
            return $make_array;

        }else{
            return [
                'id' => $this->id,
                'partner_name' => $this->partner_name,
                'partner_type' => $this->partner_type,
                'partner_code' => $this->partner_code,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'upazila_thana' => $this->upazila_thana,
                'district' => $this->District,
                'division' => $this->division,
                'signature' => $this->signature,
                'signature_url' => $this->signature_url,
            ];
        }


    }
}
