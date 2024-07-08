<?php

namespace App\Models;

use App\Models\User;
use App\Models\Insider;
use App\Models\Relative;
use App\Models\UpsiSharing;
use App\Models\FinancialRelative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConnectedPerson extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'type',
        'name',
        'iuid',
        'immediate_relative_id',
        'financial_relative_id',
        'is_insider',
        'pan',
        'pan_option',
        'pan_attachment',
        'declaration_attachment',
        'permanent_address',
        'correspondence_address',
        'nature_of_connection',
        'email',
        'mobile',
        'demat_account_number',
        'designation',
        'no_of_share_held',
        'no_of_entity',
        'entity_permanent_address',
        'entity_correspondence_address',

        'entity_declaration',
        'entity_registration_number',
        'type_of_entity',
        'authorized_personnel_name',
        'authorized_personnel_email',
        'authorized_personnel_mobile_number',

    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function immediateRelatives()
    {
        return $this->hasMany(Relative::class);
    }
    public function financialRelatives()
    {
        return $this->hasMany(FinancialRelative::class);
    }
    public function insider()
    {
        return $this->hasMany(Insider::class);
    }
    public function UPSI()
    {
        return $this->hasMany(UpsiSharing::class);
    }
    // "connected person" refers to an individual or entity who has a connection
    //  or relationship with the company, such as a shareholder, director, or 
    //  officer. On the other hand, "immediate relatives of connected persons"
    //  refer to the family members of these connected persons, such as spouses,
    //  children, or parents, who may have some level of influence or control
    //  over the connected person's relationship with the company.
}
