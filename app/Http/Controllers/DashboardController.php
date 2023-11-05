<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() : View {
        if(auth()->user()->isUser()){
            return abort(404);
        }
        return view('dashboard.index');
    }
}
