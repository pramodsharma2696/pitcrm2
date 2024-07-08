<?php

namespace App\Models;

use App\Models\User;
use App\Models\ConnectedPerson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpsiSharing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'upsi_id',
        'sender_name',
        'recipient_name',
        'recipient_category',
        'purpose_of_sharing',
        'sharing_date',
        'event_date',
        'publishing_date',
        'trading_window',
        'closure_start_date',
        'closure_end_date',
        'remarks',
        'nda_signed',
        'notice_of_confidentiality_shared',
    ];



    public function sender()
    {
        return $this->belongsTo(ConnectedPerson::class, 'sender_id')->withTrashed();
    }

    public function recipient()
    {
        return $this->belongsTo(ConnectedPerson::class, 'recipient_id')->withTrashed();
    }
    
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function insider()
    {
        return $this->hasMany(Insider::class);
    }
    public function breachOfUpsi()
    {
        return $this->hasMany(BreachOfUpsi::class);
    }

}
