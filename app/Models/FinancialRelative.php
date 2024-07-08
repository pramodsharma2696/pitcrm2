<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialRelative extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $fillable = [
        'connected_person_id',
        'nature_of_relation',
        'financial_relative_name',
        'pan',
        'mobile',
        'address',
        'nature_of_relation',
        'shares_held',
        'demat_account_number',
    ];

    public function connectedPerson()
    {
        return $this->belongsTo(ConnectedPerson::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
