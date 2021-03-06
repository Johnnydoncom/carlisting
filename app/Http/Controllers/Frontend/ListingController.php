<?php

namespace App\Http\Controllers\Frontend;

use App\Listing;
use App\Make;
use App\Category;
use App\CarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::latest()->paginate(20);
        if(request()->wantsJson()){
            return Listing::with('make','model')->get();
        };
        return view('frontend.listing.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $listing = Listing::whereSlug($slug)->first();
        return view('frontend.listing.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        if($query){
            return Listing::with('make','model')
            ->where('title', 'like', '%'.$query.'%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->orWhere('location', 'like', '%'.$query.'%')
            ->get();
        }else{
            return Listing::with('make','model')->get();
        }
        
    }


    // Category
    public function category_index(Category $category)
    {
        $categories = $category->all();
        if(request()->wantsJson()){
            return $categories;
        };
    }

    public function listing_by_category($category)
    {
        $listings = Listing::with('make','model')->where('category_id','=',$category)->get();
        if(request()->wantsJson()){
            return $listings;
        };
    }

    

    // Make
    public function make_index()
    {
        if(request()->wantsJson()){
            return Make::with('model')->get();
        };
    }
    
    public function listing_by_make($make)
    {
        if($make == 0){
            $listings = Listing::with('make','model')->get();
        }else{
            $listings = Listing::with('make','model')->where('make_id','=',$make)->get();
        }
        if(request()->wantsJson()){
            return $listings;
        }
        return $listings;
    }

    public function listing_make_models(Make $make){
        if(request()->wantsJson()){
            return CarModel::where('make_id','=',$make->id)->get();
        }
    }





}
