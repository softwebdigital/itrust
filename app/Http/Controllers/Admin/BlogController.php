<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BlogCategory;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
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
        $blog_categories = BlogCategory::orderBy('category', 'asc')->get();
        return view('admin.blog-form', compact('edit', 'blog_categories'));
    }

    public function edit(Blog $blog)
    {
        $edit = true;
        $blog_categories = BlogCategory::orderBy('category', 'asc')->get();
        return view('admin.blog-form', compact('edit', 'blog', 'blog_categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'heading' => 'required|string',
            'body' => 'required',
            'category' => 'required',
        ]);
        if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

        if ($image = $request->file('image')) {
            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:2048']);
            if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

            $name = time().$image->getClientOriginalName();
            $pic = $image->move('img/blog', $name);
        } else $pic = null;

        if (Blog::query()->create(['title' => $request['title'], 'slug' => Blog::getSlug($request['title']), 'category' => $request['category'], 'heading' => $request['heading'], 'body' => $request['body'], 'image' => $pic]))
            return redirect()->route('admin.blog')->with('success', 'News added successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'heading' => 'required|string',
            'body' => 'required',
            'category' => 'required',
            'date' => 'required'
        ]);
        if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

        if ($image = $request->file('image')) {
            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:2048']);
            if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

            $name = time().$image->getClientOriginalName();
            $pic = $image->move('img/blog', $name);
        } else $pic = $blog['image'];

        if ($blog['title'] != $request['title'])
            $blog->update(['slug' => Blog::getSlug($request['title'])]);
        if ($blog->update(['title' => $request['title'], 'category' => $request['category'], 'heading' => $request['heading'], 'body' => $request['body'], 'image' => $pic, 'created_at' => $request['date']]))
            return redirect()->route('admin.blog')->with('success', 'Blog Updated successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

//    public function store(Request $request): JsonResponse
//    {
//        $validator = Validator::make($request->all(), [
//            'title' => 'required|string',
//            'heading' => 'required|string',
//            'body' => 'required',
//            'category' => 'required',
//        ]);
//        if ($validator->fails()) return response()->json(['msg' => 'Input validation error', 'errors' => $validator->getMessageBag()], 422);
//
//        if ($image = $request->file('image')) {
//            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:2048']);
//            if ($validator->fails()) return response()->json(['msg' => 'Input validation error', 'errors' => $validator->getMessageBag()], 422);
//
//            $name = time().$image->getClientOriginalName();
//            $pic = $image->move('img/blog', $name);
//        } else $pic = null;
//
//        if (Blog::query()->create(['title' => $request['title'], 'slug' => Blog::getSlug($request['title']), 'category' => $request['category'], 'heading' => $request['heading'], 'body' => json_decode($request['body']), 'image' => $pic]))
//            return response()->json(['msg' => 'Blog created successfully']);
//        return response()->json(['msg' => 'Error'], 400);
//    }
//
//    public function update(Request $request, Blog $blog): JsonResponse
//    {
//        $validator = Validator::make($request->all(), [
//            'title' => 'required|string',
//            'heading' => 'required|string',
//            'body' => 'required',
//            'category' => 'required',
//            'date' => 'required'
//        ]);
//        if ($validator->fails()) return response()->json(['msg' => 'Input validation error', 'errors' => $validator->getMessageBag()], 422);
//
//        if ($image = $request->file('image')) {
//            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:2048']);
//            if ($validator->fails()) return response()->json(['msg' => 'Input validation error', 'errors' => $validator->getMessageBag()], 422);
//
//            $name = time().$image->getClientOriginalName();
//            $pic = $image->move('img/blog', $name);
//        } else $pic = $blog['image'];
//
//        if ($blog['title'] != $request['title'])
//            $blog->update(['slug' => Blog::getSlug($request['title'])]);
//        if ($blog->update(['title' => $request['title'], 'category' => $request['category'], 'heading' => $request['heading'], 'body' => json_decode($request['body']), 'image' => $pic, 'created_at' => $request['date']]))
//            return response()->json(['msg' => 'Blog Updated successfully']);
//        return response()->json(['msg' => 'Error'], 400);
//    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->delete())
            return back()->with('success', 'Blog deleted successfully');
        return back()->with('error', 'An error occurred, try again');
    }
}
