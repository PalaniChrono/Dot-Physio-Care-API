<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'testimony';
    protected $primaryKey = 'id';
    protected $fillable = [
        'author',
    'testimony_header',
    'testimony_description',
    'testimony_image',
    'active_status',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
