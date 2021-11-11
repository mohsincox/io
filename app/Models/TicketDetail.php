<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TicketDetail extends Model
{
	protected $table = 'ticket_details';

    public function ticketStatus()
    {
    	return $this->belongsTo(TicketStatus::class, 'ticket_status_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
