<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    protected $table = 'crms';

    public function division()
    {
    	return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
    	return $this->belongsTo(District::class, 'district_id');
    }
}
