<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'offer_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'conversation_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\Models\CompanyOffer', 'offer_id');
    }
}
