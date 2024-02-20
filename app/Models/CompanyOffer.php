<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyOffer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_offers';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
