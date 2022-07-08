<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    protected $fillable = [
    'banner_name',
    'banner_image',
    'active_status',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
