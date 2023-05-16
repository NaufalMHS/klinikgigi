<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAppointmentTransaction extends Model
{
    protected $table = 'users';

    public function appointments()
    {
        return $this->hasManyThrough(Appointment::class, Transaction::class, 'user_id', 'id', 'id', 'appointment_id');
    }
}
