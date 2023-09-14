<?php

namespace App\Http\Controllers;

use App\Models\Post;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

}
