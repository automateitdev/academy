<?php

namespace App\Http\Controllers\dashboard\examManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;

class ExamStartupController extends Controller
{
    public function index()
    {
        $users = User::all();
        $startups = Startup::all();
        return view('layouts.dashboard.exam_management.settings.examstartup.index', compact('users','startups'));
    }
}
