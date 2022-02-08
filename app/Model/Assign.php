<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
