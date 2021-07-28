<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        return view('admin.index', compact('admin'));
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
    public function settings()
    {
        $admin = auth('admin')->user();
        return view('admin.payouts', compact('admin'));
    }
}
