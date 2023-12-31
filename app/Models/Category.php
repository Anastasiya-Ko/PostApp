<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //разрешение дл редактирования данных в бд
    protected $guarded = false;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
