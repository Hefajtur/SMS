<?php

namespace App\Http\Controllers\backend\adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminPanelController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            if(Auth::user()->role == 1) {
                return view('dashboard.master');
            }

            if(Auth::user()->role == 2) {
                return view('dashboard.adminpanel.admindashboard.admin');
            }

            if(Auth::user()->role == 3) {
                return view('dashboard.adminpanel.parentdashboard.teacher');
            }

            if(Auth::user()->role == 4) {
                return view('dashboard.adminpanel.studentdashboard.student');
            }

            if(Auth::user()->role == 5) {
                return view('dashboard.adminpanel.parentdashboard.parent');
            }

            if(Auth::user()->role == 6) {
                return view('dashboard.adminpanel.userdashboard.user');
            }
            
            else {
                return redirect()->back();
            }
        }
    }
}
