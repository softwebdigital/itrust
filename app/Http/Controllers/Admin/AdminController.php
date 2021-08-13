<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{

//Host: 41.203.16.246
//U: lushgetqre
//P: ob3Sv53L5d3RlVGioK7d
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

    public function userAccountAction(User $user, $action): RedirectResponse
    {
        if (!in_array($action, ['approved', 'declined', 'suspended'])) return back()->with('error', 'Invalid action');
        if (!$user) return back()->with('error', 'User not found');
        if ($user->update(['status' => $action])) return back()->with('success', 'User account '.$action.' successfully');
        return back()->with('error', 'An error occurred, try again.');
    }

    public function settings()
    {
        $admin = auth('admin')->user();
        return view('admin.payouts', compact('admin'));
    }
}
