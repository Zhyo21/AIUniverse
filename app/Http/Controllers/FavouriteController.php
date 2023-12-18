<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $websitesWithCategories = DB::table("websites")->leftJoin('favourites', "favourites.website_id", '=', "websites.id")->leftJoin("users", "users.id", "=", "favourites.user_id")->leftJoin('ratings', 'ratings.website_id', '=', 'websites.id')->select('websites.*', "users.id as user_id",  DB::raw('AVG(ratings.rating) as avg_rating'))->groupBy(
            'websites.id',
            'websites.title',
            'websites.description',
            'websites.url',
            'websites.image_url',
            'websites.created_at',
            'websites.updated_at',
            'users.id'
        )->where("users.id", "=", Auth::user()->id)->get();

        return view("favourites.index", ["websites" => $websitesWithCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $favourite = new Favourite();
        $favourite->user_id = Auth::user()->id;
        $favourite->website_id = $request->id;

        $favourite->save();

        return redirect("/website");
    }

    /**
     * Display the specified resource.
     */
    public function show(Favourite $favourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favourite $favourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //  
        Favourite::where("user_id", "=", Auth::user()->id)->where("website_id", "=", $request->id)->delete();

        return redirect("/favourite");
    }
}
