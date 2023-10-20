<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){


        return view('admin.notifications.index', [
            'notifications' => auth()->user()->notifications()->paginate(25)
        ]);
    }
}
