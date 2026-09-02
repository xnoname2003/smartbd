<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ServiceCategory extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'slug'];

    public function upworkLeads()
    {
        return $this->hasMany(UpworkLead::class);
    }

    public function searchKeywords()
    {
        return $this->hasMany(SearchKeyword::class);
    }
}
