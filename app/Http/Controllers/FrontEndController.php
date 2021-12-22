<?php

namespace App\Http\Controllers;

use App\Models\Admin\BlogCategory;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);
        $popular_blogs = Blog::orderBy('id', 'desc')->take(5)->get();

        $first_blog = Blog::orderBy('id', 'desc')->first();

        return view('frontend.blog', compact('blogs', 'blogCategories', 'first_blog', 'popular_blogs'));
    }

    public function blogview(Request $request, $id)
    {
        $blog_post = Blog::findOrFail($id);
        $total_comments = $blog_post->comments()->count();
        $comments = $blog_post->comments()->paginate(5);
        if ($request->ajax()){
            $view = view('frontend.comments', compact('comments'))->render();
            return response()->json(['html' => $view]);
        }
        $other_blogs = Blog::orderBy('id', 'desc')->take(5)->get();

        return view('frontend.blogview', compact('blog_post', 'other_blogs', 'comments', 'total_comments'));
    }


    public function addComment(Request $request, $blog_id)
    {
        // dd($request->all(), $blog_id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'comment' => 'required|min:5',
        ]);
        // dd($validator->errors());
        if ($validator->fails()) return back()->withInput()->withErrors($validator);


        $comment = new Comment();
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->comment = $request->input('comment');
        $comment->post_id = $blog_id;

        if ($comment->save()){
            // Session::flash('success', 'Comment Successfully Added);
            return redirect()->route('frontend.blogview', $blog_id)->with('success', 'Comment Successfully Added');}
        return back()->with('error', 'An error occurred, try again.')->withInput();
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
