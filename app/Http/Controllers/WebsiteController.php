<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Website;
use App\Models\WebsiteCategories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        if (Auth::user()) {
            $websitesWithCategories =
                Website::leftJoin('favourites', 'favourites.website_id', '=', 'websites.id')
                ->leftJoin('users', 'users.id', '=', 'favourites.user_id')
                ->leftJoin('ratings', 'ratings.website_id', '=', 'websites.id')
                ->select(
                    'websites.*',
                    'users.id as user_id',
                    DB::raw('AVG(ratings.rating) as avg_rating')
                )
                ->where(function ($query) {
                    $query->where('users.id', '=', Auth::user()->id)
                        ->orWhereNull('users.id');
                })
                ->groupBy(
                    'websites.id',
                    'websites.title',
                    'websites.description',
                    'websites.url',
                    'websites.image_url',
     
                    'websites.created_at',
                    'websites.updated_at',
                    'users.id'
                )
                ->get();
            $categories = Category::all();

            return view("websites.index", ["websites" => $websitesWithCategories, "categories" => $categories]);
        } else {
            $websitesWithCategories = Website::leftJoin('favourites', 'favourites.website_id', '=', 'websites.id')
                ->leftJoin('ratings', 'ratings.website_id', '=', 'websites.id')
                ->select(
                    'websites.*',
                    DB::raw('AVG(ratings.rating) as avg_rating')
                )->groupBy(
                    'websites.id',
                    'websites.title',
                    'websites.description',
                    'websites.url',
                    'websites.image_url',
                    
                    'websites.created_at',
                    'websites.updated_at'
                )
                ->get();

            $categories = Category::all();

            return view("websites.index", ["websites" => $websitesWithCategories, "categories" => $categories]);
        }
    }

    public function filter(Request $request)
    {

        if ($request->get("filter")) {
            if (Auth::user()) {
                $websitesWithCategories =
                    Website::leftJoin('website_categories', 'website_categories.website_id', '=', 'websites.id')
                    ->leftJoin('categories', 'website_categories.category_id', '=', 'categories.id')
                    ->leftJoin('favourites', 'favourites.website_id', '=', 'websites.id')
                    ->leftJoin('users', 'users.id', '=', 'favourites.user_id')
                    ->leftJoin('ratings', 'ratings.website_id', '=', 'websites.id')
                    ->select(
                        'websites.*',
                        'categories.name as category_name',
                        'users.id as user_id',
                        DB::raw('AVG(ratings.rating) as avg_rating')
                    )
                    ->where(function ($query) {
                        $query->where('users.id', '=', Auth::user()->id)->orWhereNull('users.id');
                    })->where("categories.id", "=", $request->get("filter"))
                    ->groupBy(
                        'websites.id',
                        'websites.title',
                        'websites.description',
                        'websites.url',
                        'websites.image_url',
                     
                        'websites.created_at',
                        'websites.updated_at',
                        'categories.name',
                        'users.id'
                    )
                    ->get();
                $categories = Category::all();
                return view("websites.index", ["websites" => $websitesWithCategories, "categories" => $categories]);
            } else {
                $websitesWithCategories = Website::leftJoin('website_categories', 'website_categories.website_id', '=', 'websites.id')
                    ->leftJoin('categories', 'website_categories.category_id', '=', 'categories.id')
                    ->leftJoin('favourites', 'favourites.website_id', '=', 'websites.id')
                    ->leftJoin('users', 'users.id', '=', 'favourites.user_id')
                    ->leftJoin('ratings', 'ratings.website_id', '=', 'websites.id')
                    ->select(
                        'websites.*',

                        'categories.name as category_name',
                        'users.id as user_id',
                        DB::raw('AVG(ratings.rating) as avg_rating')
                    )->where("categories.id", "=", $request->get("filter"))
                    ->groupBy(
                        'websites.id',
                        'websites.title',
                        'websites.description',
                        'websites.url',
                        'websites.image_url',
                   
                        'websites.created_at',
                        'websites.updated_at',
                        'categories.name',
                        'users.id'
                    )
                    ->get();

                $categories = Category::all();

                return view("websites.index", ["websites" => $websitesWithCategories, "categories" => $categories]);
            }
        } else if ($request->get("search")) {
            # code...
            if (Auth::user()) {
                $websitesWithCategories =
                    Website::
                    leftJoin('favourites', 'favourites.website_id', '=', 'websites.id')
                    ->leftJoin('users', 'users.id', '=', 'favourites.user_id')
                    ->leftJoin('ratings', 'ratings.website_id', '=', 'websites.id')
                    ->select(
                        'websites.*',
           
                        'users.id as user_id',
                        DB::raw('AVG(ratings.rating) as avg_rating')
                    )
                    ->where(function ($query) {
                        $query->where('users.id', '=', Auth::user()->id)->orWhereNull('users.id');
                    })->where('websites.title', 'like', '%' . $request->get('search') . '%')
                    ->groupBy(
                        'websites.id',
                        'websites.title',
                        'websites.description',
                        'websites.url',
                        'websites.image_url',
              
                        'websites.created_at',
                        'websites.updated_at',
              
                        'users.id'
                    )
                    ->get();
                $categories = Category::all();
                return view("websites.index", ["websites" => $websitesWithCategories, "categories" => $categories]);
            } else {
                $websitesWithCategories = Website::
                    leftJoin('favourites', 'favourites.website_id', '=', 'websites.id')
                    ->leftJoin('users', 'users.id', '=', 'favourites.user_id')
                    ->leftJoin('ratings', 'ratings.website_id', '=', 'websites.id')
                    ->select(
                        'websites.*',
                        'users.id as user_id',
                        DB::raw('AVG(ratings.rating) as avg_rating')
                    )->where('websites.title', 'like', '%' . $request->get('search') . '%')
                    ->groupBy(
                        'websites.id',
                        'websites.title',
                        'websites.description',
                        'websites.url',
                        'websites.image_url',
                        'websites.created_at',
                        'websites.updated_at',
                        'users.id'
                    )
                    ->get();

                $categories = Category::all();

                return view("websites.index", ["websites" => $websitesWithCategories, "categories" => $categories]);
            }
        } else {

            return redirect("/website");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $categories = new Category();

        if ($categories::count() > 0) {
            # code...
            return view("Websites.create", ["categories" => $categories]);
        } else {
            return redirect("/category/create");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        $validated = $request->validate([
            "title" => "required",
            "desc" => "required",
            "url" => "required",
            "cat_id" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $fileName);

        $website = new Website();
        $website->title = $request->title;
        $website->description = $request->desc;
        $website->url = $request->url;
        $website->image_url = $fileName;
        $website->save();
        
        $cats =  $request->cat_id;

        foreach ($cats as $key => $value) {
            # code...
              $category = new WebsiteCategories();
              $category->website_id = $website->id;
              $category->category_id = $value;
              $category->save();
        }


        return redirect("/dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $website = Website::find($id);


        return view("websites.show", ["website" => $website]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $categories = new Category();
        $website = new Website();

        return view("websites.edit", ["categories" => $categories, "website" => $website::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            "title" => "required",
            "desc" => "required",
            "url" => "required",
        ]);
        $website = Website::find($id);

        if ($request->image != null) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);


            $website->title = $request->title;
            $website->description = $request->desc;
            $website->url = $request->url;
            $website->image_url = $fileName;
            $website->update();
        } else {

            $website->title = $request->title;
            $website->description = $request->desc;
            $website->url = $request->url;
            $website->update();
        }

        return redirect("/dashboard");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $website = Website::find($id);
        $website->delete();

        return redirect("/dashboard");
    }
}
