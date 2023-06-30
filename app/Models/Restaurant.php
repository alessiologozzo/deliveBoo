<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo', 'address', 'slug'];


    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    public function category(): HasMany
    {
        return $this->HasMany(Category::class);
    }
}
