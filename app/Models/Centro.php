<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Centro extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id','name','alias', 'legal_entity_id','main'
    ];

    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'centro');
    }


    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }


    public function scopeOfCentroStock($query)
    {

        return $query->whereHas('centro_quantidade', function ($query) {

        });

    }

    public function scopeOfCentroStockin($query)
    {

        return $query->whereHas('centro_quantidade', function ($query) {
            $query->where('quantidade','>','0');
        });

    }

}
