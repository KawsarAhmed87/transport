<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    public function servicetype()
    {
        return $this->belongsTo(Self::class, 'parent_id', 'id');
    }
}
