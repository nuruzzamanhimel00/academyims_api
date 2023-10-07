<?php

namespace App\Models;

use App\Utils\GlobalConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnersInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_name',
        'partner_type',
        'partner_code',
        'mobile',
        'email',
        'upazila_thana',
        'district',
        'division',
        'signature',
    ];

    protected $appends = ['signature_url'];

    public function getSignatureUrlAttribute(){
        return getStorageImage(GlobalConstant::PARTNERS_IMAGE_PATH, $this->signature);
    }
}
