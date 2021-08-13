<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        $news = News::query()->latest()->get();
        return view('admin.news', compact('admin', 'news'));
    }

    public function create()
    {
        $edit = false;
        return view('admin.news-form', compact('edit'));
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
            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:1024']);
            if ($validator->fails()) return back()->withInput()->withErrors($validator);

            $name = time().$image->getClientOriginalName();
            $pic = $image->move('img/news', $name);
        } else $pic = null;

        if (News::query()->create(['title' => $request['title'], 'heading' => $request['heading'], 'url' => $request['url'], 'date_range' => $request['date'], 'body' => $request['body'], 'image' => $pic]))
            return redirect()->route('admin.news')->with('success', 'News added successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    public function edit(News $news)
    {
        $edit = true;
        return view('admin.news-form', compact('edit', 'news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'url' => 'required|url',
            'date' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) return back()->withInput()->withErrors($validator);

        if ($image = $request->file('image')) {
            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:1024']);
            if ($validator->fails()) return back()->withInput()->withErrors($validator);

            $name = time().$image->getClientOriginalName();
            $news['image'] = $image->move('img/news', $name);
        }

        $news['title'] = $request['title'];
        $news['heading'] = $request['heading'];
        $news['body'] = $request['body'];
        $news['url'] = $request['url'];
        $news['date_range'] = $request['date'];

        if ($news->update())
            return redirect()->route('admin.news')->with('success', 'News updated successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    public function destroy(News $news): RedirectResponse
    {
        if ($news->delete())
            return back()->with('success', 'News deleted successfully');
        return back()->with('error', 'An error occurred, try again');
    }
}
