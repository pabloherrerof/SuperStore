<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'color'
    ];

    public function groups()
    {
        return $this->belongsTo(Groups::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function clients()
    {
        return $this->belongsToMany(User::class);
    }
}
