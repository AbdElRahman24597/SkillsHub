<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['popularExams'] = Exam::withCount('users')->orderBy('users_count', 'desc')->take(8)->get();

        return view('web.home.index')->with($data);
    }
}
