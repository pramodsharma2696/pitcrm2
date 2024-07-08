<?php

namespace App\Models;

use App\Models\User;
use App\Models\ConnectedPerson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insider extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_type',
        'type',
        'name',

        'pan',
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
        'authorized_personnel_name',
        'authorized_personnel_email',
        'authorized_personnel_mobile_number',

    ];







    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function connectedPerson()
{
    return $this->belongsTo(ConnectedPerson::class);
}
}
