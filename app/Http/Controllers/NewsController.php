<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        if (News::query()->create(['title' => $request['title'], '']))
            return redirect()->route('admin.news');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    public function edit(News $news)
    {
        $edit = true;
        $news = collect(['title' => 'title', 'body' => '<p>Testing i23</p>', 'date' => now(), 'heading' => '', 'image' => 'assets/images/bg-1.jpg']);
        return view('admin.news-form', compact('edit', 'news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
//        if ($news->update())
        return redirect()->route('admin.news');
//        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    public function destroy(News $news): RedirectResponse
    {
        //
    }
}
