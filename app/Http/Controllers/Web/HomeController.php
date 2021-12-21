<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['popularExams'] = Exam::active()->withCount('users')->latest('users_count')->take(8)->get();

        return view('web.home.index')->with($data);
    }
}
