<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','description','price','cost','stock','category_id'
    ];

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
