<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'activity',
        'address',
        'postal_code',
        'city',
        'phone',
        'email',
        'logo',
        'banner',
    ];

    public function offers()
    {
        return $this->hasMany('App\Models\CompanyOffer');
    }

    public function user()
    {
        return $this->hasOne(ApplyOffer::class, 'company_id');
    }
}
