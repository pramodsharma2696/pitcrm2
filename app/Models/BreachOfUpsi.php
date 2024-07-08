<?php

namespace App\Models;

use App\Models\User;
use App\Models\Insider;
use App\Models\UpsiSharing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BreachOfUpsi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'upsi_id',
        'insider_name',
        'effect_of_breach',
        'gain_or_loss',
        'action_taken',
        'breach_type',
        'breach_details',
        'reporting_date',
        'status',
        'action_taken',
    ];








    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function upsi()
    {
        return $this->belongsTo(UpsiSharing::class);
    }

    public function insider()
    {
        return $this->belongsTo(Insider::class);
    }
}
