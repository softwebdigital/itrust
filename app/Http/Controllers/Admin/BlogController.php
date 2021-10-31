<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        $news = Blog::query()->latest()->get();
        return view('admin.blog', compact('admin', 'news'));
    }


    public function create()
    {
        $edit = false;
        return view('admin.blog-form', compact('edit'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'url' => 'required|url',
            'date' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) return back()->withInput()->withErrors($validator);

        if ($image = $request->file('image')) {
            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:2048']);
            if ($validator->fails()) return back()->withInput()->withErrors($validator);

            $name = time().$image->getClientOriginalName();
            $pic = $image->move('img/blog', $name);
        } else $pic = null;

        if (Blog::query()->create(['title' => $request['title'], 'heading' => $request['heading'], 'url' => $request['url'], 'date_range' => $request['date'], 'body' => $request['body'], 'image' => $pic]))
            return redirect()->route('admin.blog')->with('success', 'News added successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }
}
