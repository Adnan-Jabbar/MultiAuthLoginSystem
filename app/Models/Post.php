<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'admin_id'];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
