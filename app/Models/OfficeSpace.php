<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfficeSpace extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'address',
        'is_open',
        'is_full_booked',
        'price',
        'duration',
        'city_id'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function photos(): HasMany
    {
        return $this->hasMany(OfficeSpacePhoto::class, 'office_space_id');
    }
    public function benefits(): HasMany
    {
        return $this->hasMany(OfficeSpaceBenefits::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
