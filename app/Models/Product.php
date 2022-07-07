<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{


    protected $fillable =[
        'id',
        'category_id',
        'collection_id',
        'criacao_id',
        'name',
        'description',
        'recommended',
        'featured',
        'line_up',
        'slug',
        'gem_description',
        'dimensoes',
        'destaque',
    ];

    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function description(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }


    public function category()
    {
        return $this->belongsTo(Category::class);

    }
    public function collection()
    {
        return $this->belongsTo(Collection::class);

    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);

    }

    public function stock()
    {
        return $this->hasOne(Stock::class);

    }
    public function stock_in()
    {
        return $this->hasMany(StockIn::class);

    }
    public function stock_out()
    {
        return $this->hasMany(StockOut::class);

    }

    public function scopeOfSearch($query, $search)
    {
        return $query->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('id', 'LIKE', '%' . $search . '%')->with('images','stock');
    }


}

