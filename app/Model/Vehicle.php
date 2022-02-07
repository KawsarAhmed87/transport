<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function vehicle_type()
    {
        return $this->belongsTo(Vehicletype::class, 'vehi_type_id', 'id');
    }
    public function vehicle_category()
    {
        return $this->belongsTo(Vehicletype::class, 'vehi_cat_id', 'id');
    }
    public function colour()
    {
        return $this->belongsTo(Colour::class, 'colour_id', 'id');
    }
    

}
