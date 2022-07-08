<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'specialization_details';
    protected $primaryKey = 'id';
    protected $fillable = [
    'header',
    'description',
    'image',
    'active_status',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
