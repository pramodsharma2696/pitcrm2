<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialRelativeDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'file_path',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
