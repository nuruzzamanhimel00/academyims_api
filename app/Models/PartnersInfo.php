<?php

namespace App\Models;

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
}
