<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function profile()
    {
        $admin = auth('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $admin = Admin::find(auth('admin')->id());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'photo' => 'sometimes|file|mimes:jpg,png,jpeg|max:1024'
        ]);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        if ($image = $request->file('photo')) {
            $name = time().$image->getClientOriginalName();
            $admin['photo'] = $image->move('img/avatar', $name);
        }

        $admin['name'] = $request['name'];
        if ($admin->update())
            return back()->with('success', 'Profile updated successfully');
        return back()->with('error', 'Could not update profile, try again');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $admin = Admin::find(auth('admin')->id());
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) return back()->withErrors($validator);

        if (!Hash::check($request['new_password'], $admin['password']))
            return back()->with('error', 'Old password is incorrect');
        if ($admin->update(['password' => Hash::make($request['new_password'])]))
            return back()->with('success', 'Password update successfully');
        return back()->with('error', 'Could not update password, try again');
    }

    public function settings()
    {
        $admin = auth('admin')->user();
        return view('admin.settings', compact('admin'));
    }
}
