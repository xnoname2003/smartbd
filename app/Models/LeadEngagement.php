<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LeadEngagement extends Model
{
    use HasUuids;

    protected $fillable = ['upwork_lead_id', 'status', 'note'];

    public function upworkLead()
    {
        return $this->belongsTo(UpworkLead::class);
    }
}
