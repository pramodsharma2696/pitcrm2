<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Relative;
use App\Models\CompanyData;
use App\Models\UpsiSharing;
use App\Models\BreachOfUpsi;
use App\Models\UpsiDocument;
use App\Models\CompanyDocument;
use App\Models\ConnectedPerson;
use App\Models\InsiderDocument;
use App\Models\FinancialRelative;
use Laravel\Sanctum\HasApiTokens;
use App\Models\BreachUpsiDocument;
use App\Models\ConnectedPersonDocument;
use Illuminate\Notifications\Notifiable;
use App\Models\FinancialRelativeDocument;
use App\Models\ImmediateRelativeDocument;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'designation',
        'authorized',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }
    public function checkAuthorized(string $role): bool
    {
        return $this->getAttribute('authorized') === $role;
    }

    public function CompanyData()
    {
        return $this->hasMany(CompanyData::class);
    }
    public function ConnectedPersonDocument()
    {
        return $this->hasMany(ConnectedPersonDocument::class);
    }
    public function UpsiDocument()
    {
        return $this->hasMany(UpsiDocument::class);
    }
    public function BreachUpsiDocument()
    {
        return $this->hasMany(BreachUpsiDocument::class);
    }
    public function InsiderDocument()
    {
        return $this->hasMany(InsiderDocument::class);
    }

    public function ConnectedPerson()
    {
        return $this->hasMany(ConnectedPerson::class);
    }

    public function relatives()
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
    public function upsiSharing()
    {
        return $this->hasMany(UpsiSharing::class);
    }
    public function createdByUpsiSharings()
{
    return $this->hasMany(UpsiSharing::class, 'created_by');
}
    public function breachOfUpsi()
    {
        return $this->hasMany(BreachOfUpsi::class);
    }
    public function financialRelativeDocument()
    {
        return $this->hasMany(FinancialRelativeDocument::class);
    }
    public function immediateRelativeDocument()
    {
        return $this->hasMany(ImmediateRelativeDocument::class);
    }
    public function companyDocuments()
{
    return $this->hasMany(CompanyDocument::class);
}
}
