<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        // dd(request('tag'));
        // dd(request()->tag);
        return view('listings.index',[
            'heading' => 'Latest Listings',
            'listings' => Listing::latest()->filter(request(['tag','search']))->get()
        ]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show',[
            'listing' => $listing
        ]);

    }

 
    public function create()
    {
        return view('listings.create');

    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            // Avoid duplicate data in the same column 
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        return redirect('/');

    }

}
