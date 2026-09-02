<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SearchKeyword extends Model
{
    use HasUuids;

    protected $fillable = ['service_category_id', 'keyword', 'is_active'];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
