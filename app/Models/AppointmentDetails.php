<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'appointment_details';
    protected $primaryKey = 'id';
    protected $fillable = [
    'customer_name',
    'customer_no',
    'date',
    'purpose_visit',
    'active_status',
    'updated_at'
    ];
    // protected $hidden = ['updated_at'];
}
