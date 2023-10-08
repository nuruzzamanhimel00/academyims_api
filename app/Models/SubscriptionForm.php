<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'agreement_date',
        'validity_date',
        'duration',
        'institute_name',
        'authority_name',
        'authority_designation',
        'authority_mobile',
        'telephone',
        'email',
        'chairman_name',
        'chairman_mobile',
        'ict_in_charge',
        'ict_in_charge_mobile',
        'address',
        'upazila_thana',
        'district',
        'division',
        'institute_type',
        'education_board',
        'module_list',
        'student_quantity',
        'hr_number_quantity',
        'payment_type',
        'institute_domain',
        'data_submission_date',
        'tentative_handover_date',
        'sign_2nd',
    ];

    public function partner(){
        return $this->belongsTo(PartnersInfo::class,'partner_id','id');
    }
}
