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

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_category');
    }
}
