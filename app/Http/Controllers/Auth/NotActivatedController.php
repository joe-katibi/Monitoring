<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotActivatedController extends Controller
{
    public function showNotActivated()
    {
        return view('auth.notActivated');
    }
}
