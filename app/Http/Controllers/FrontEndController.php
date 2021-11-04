<?php

namespace App\Http\Controllers;

use App\Models\Admin\BlogCategory;
use App\Models\Blog;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{


    public function home()
    {
        return view('frontend.index');
    }

    public function stocks()
    {
        return view('frontend.stock');
    }

    public function crypto()
    {
        return view('frontend.crypto');
    }

    public function gold()
    {
        return view('frontend.gold');
    }

    public function cash()
    {
        return view('frontend.cash');
    }

    public function options()
    {
        return view('frontend.options');
    }


    public function invest()
    {
        return view('frontend.how_to_invest');
    }

    public function about()
    {
        return view('frontend.aboutus');
    }

    public function blog()
    {
        $blogCategories = BlogCategory::all();
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('frontend.blog', compact('blogs', 'blogCategories'));
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }


    public function faq()
    {
        return view('frontend.faq');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function commitments()
    {
        return view('frontend.our_commitment');
    }

    public function investor_relations()
    {
        return view('frontend.investor_relations');
    }

}
