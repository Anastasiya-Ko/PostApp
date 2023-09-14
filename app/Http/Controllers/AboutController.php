<?php

namespace App\Http\Controllers;

use App\Models\Post;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutController extends Controller
{
    public function index()
    {
        return view('about');
    }

}
