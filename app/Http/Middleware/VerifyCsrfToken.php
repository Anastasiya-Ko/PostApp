<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //здесь прописывам роут, на который больше не будет распространяться @csrf
        //это нужно для работы методов пост и патч в постмане
        '/posts',
        '/posts/*'
    ];
}
