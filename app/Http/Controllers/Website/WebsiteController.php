<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WebsiteController extends Controller
{
    public function index()
    {
        return view('content.website.index');
    }

}
