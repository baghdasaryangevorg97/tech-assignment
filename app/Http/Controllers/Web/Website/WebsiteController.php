<?php

namespace App\Http\Controllers\Web\Website;

use App\Http\Controllers\Controller;


class WebsiteController extends Controller
{
    public function index()
    {
        return view('content.website.index');
    }

}
