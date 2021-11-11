<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SmsSend extends Model
{
    protected $table = 'sms_sends';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
