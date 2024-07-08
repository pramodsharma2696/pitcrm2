<?php

namespace App\Models;

use App\Models\User;
use App\Models\ConnectedPerson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relative extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'connected_person_id',
        'relative_name',
        'pan',
        'mobile',
        'address',
        'nature_of_relation',
        'type_of_relation',
        'shares_held',
        'demat_account_no',
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
