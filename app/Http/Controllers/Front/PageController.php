<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Page;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke(Page $page)
    {
        return view('front.page', compact('page'));
    }
}
