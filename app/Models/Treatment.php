<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'treatment';
    protected $primaryKey = 'id';
    protected $fillable = [
    'header',
    'logo',
    'active_status',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
