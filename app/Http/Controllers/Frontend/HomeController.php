<?php

namespace App\Http\Controllers\Frontend;

use App\Listing;
use App\Http\Controllers\Controller;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$listings = Listing::latest()->take(6)->get();
        return view('frontend.index', compact('listings'));
    }
}
