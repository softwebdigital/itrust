<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        return view('admin.index', compact('admin'));
    }
    public function users()
    {
        $users = User::query()->orderByDesc('created_at')->get();
        return view('admin.users', compact('users'));
    }
    public function user(User $user)
    {
        return view('admin.user-info', compact('user'));
    }
    public function deposits()
    {
        $admin = auth('admin')->user();
        return view('admin.deposits', compact('admin'));
    }
    public function transactions()
    {
        $admin = auth('admin')->user();
        return view('admin.transactions', compact('admin'));
    }
    public function payouts()
    {
        $admin = auth('admin')->user();
        return view('admin.payouts', compact('admin'));
    }
    public function news()
    {
        $admin = auth('admin')->user();
        return view('admin.news', compact('admin'));
    }
    public function addNews()
    {
        $edit = false;
        return view('admin.news-form', compact('edit'));
    }
    public function editNews(/*News $news*/)
    {
        $edit = true;
        $news = collect(['title' => 'title', 'body' => '<p>Testing i23</p>', 'date' => now(), 'heading' => '', 'image' => 'assets/images/bg-1.jpg']);
        return view('admin.news-form', compact('edit', 'news'));
    }
    public function storeNews(Request $request): RedirectResponse
    {
//        $news = new News;
//        if ($news->save())
            return redirect()->route('admin.news');
//        return back()->with('error', 'An error occurred, try again.')->withInput();
    }
    public function updateNews(Request $request/*, News $news*/): RedirectResponse
    {
//        if ($news->update())
            return redirect()->route('admin.news');
//        return back()->with('error', 'An error occurred, try again.')->withInput();
    }
    public function settings()
    {
        $admin = auth('admin')->user();
        return view('admin.payouts', compact('admin'));
    }
}
