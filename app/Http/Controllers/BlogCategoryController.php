<?php

namespace App\Http\Controllers;

use App\Models\Admin\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogCategory = BlogCategory::orderBy('id', 'desc')->get();
        // dd($blogCategory);
        return view('admin.blogcategory', compact('blogCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('admin.blog-category-form', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
        ]);
        if ($validator->fails()) return back()->withInput()->with('error', $validator->errors()->first());


        if (BlogCategory::query()->create(['category' => $request['category']]))
            return redirect()->route('admin.blogCategory')->with('success', 'Blog Category added successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
        ]);
        if ($validator->fails()) return back()->withInput()->with('error', $validator->errors()->first());

        $category = BlogCategory::findOrFail($id);
        if ($category->update(['category' => $request['category']]))
            return redirect()->route('admin.blogCategory')->with('success', 'Blog Category updated successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory, $id)
    {
        $category = BlogCategory::findOrFail($id);
        if ($category->delete())
            return redirect()->route('admin.blogCategory')->with('success', 'Blog Category deleted successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

}
