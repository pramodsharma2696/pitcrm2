<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'registered_office',
        'corporate_office',
        'mobile',
        'email',
        'cin',
        'isin',
        'bse_scrip_code',
        'nse_scrip_code',
        'compliance_officer_name',
        'compliance_officer_mail',
        'compliance_officer_designation',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function complianceOfficer()
    // {
    //     return $this->belongsTo(User::class, 'compliance_officer_id');
    // }
}
