<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;
use App\Models\Countries;

class SystemLink extends Model
{
    use HasFactory;
    protected $fillable=[
        'site_name',
        'service_id',
        'country_id',
        'site_url',
        'site_image',
        'created_by',
        'update_by',


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

    public function services()
    {
        return $this->belongsToMany(Services::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Countries::class);
    }
}
