<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use RadHam\Reflect;

class ReflectionController extends Controller
{
    /**
     * Return a token reflection.
     *
     * @param Request $request
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $token)
    {
        return Reflect::factory($token);
    }
}
