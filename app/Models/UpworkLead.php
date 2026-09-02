<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UpworkLead extends Model
{
    use HasUuids;

    protected $fillable = [
        'service_category_id', 'job_title', 'description', 
        'budget', 'client_payment_status', 'url', 'rank', 'ditemukan_pada'
    ];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function engagements()
    {
        return $this->hasMany(LeadEngagement::class);
    }
}
