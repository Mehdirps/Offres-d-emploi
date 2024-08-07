<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'user_id',
        'status',
        'message',
        'curriculum',
        'cover_letter',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function offer()
    {
        return $this->belongsTo('App\Models\CompanyOffer');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
