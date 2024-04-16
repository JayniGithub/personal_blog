<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'blg_facebook',
        'blg_instergram',
        'blg_youtube',
        'blg_linkedin'
    ];
}
