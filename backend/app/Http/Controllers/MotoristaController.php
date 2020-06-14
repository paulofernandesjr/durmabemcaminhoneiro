<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function motorista(Request $request)
    {
        return $request->user();
    }
}
