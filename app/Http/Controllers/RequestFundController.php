<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestFund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\FundsNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class RequestFundController extends Controller
{

    public function index()
    {
        $admin = auth('admin')->user();

        $funds = RequestFund::query()->latest()->get();
        return view('admin.funds', compact('admin', 'funds'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'account' => 'required|string',
            'amount' => 'required',
            'reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->getMessageBag());
        }

        // Check if there is an existing pending fund request for the user
        $authUserId = Auth::id();
        $existingRequest = RequestFund::where('user_id', $authUserId)->where('status', 'pending')->first();

        if ($existingRequest) {
            return back()->with('error', 'You already have an existing pending fund request.')->withInput();
        }

        // Create a new fund request
        $funds = RequestFund::create([
            'user_id' => $authUserId,
            'account' => $request->input('account'),
            'amount' => $request->input('amount'),
            'code' => $request->input('code'),
            'reason' => $request->input('reason'),
            'status' => 'pending',
        ]);

        // Get user information
        $user = User::find($authUserId);

        // Send confirmation email to the user
        $userMailData = [
            'name' => $user->name,
            'subject' => 'Confirmation of Fund Request',
            'body' => 'We would like to confirm that we have received your fund request. Our dedicated team will now initiate the required procedures to facilitate the funding of your account. <br> Rest assured that we will keep you informed of the progress through this email address.',
        ];

        if ($funds) {
            MailController::sendFundNotification($user, $userMailData);
        }

        // Send notification email to the admin
        $adminMailData = [
            'name' => 'Admin',
            'subject' => 'New Fund Request',
            'body' => '<p>A new fund request has been submitted. Below are the details:</p>
                        <ul>
                            <li><strong>User:</strong> ' . $user->name . '</li>
                            <li><strong>Account:</strong> ' . $request->input('account') . '</li>
                            <li><strong>Amount:</strong> ' . $request->input('amount') . '</li>
                            <li><strong>Code:</strong> ' . $request->input('code') . '</li>
                            <li><strong>Reason:</strong> ' . $request->input('reason') . '</li>
                        </ul>',
        ];

        if ($funds) {
            $emailAddress = 'transactions@itrustinvestment.com';

            Notification::route('mail', $emailAddress)->notify(new FundsNotification($adminMailData));
        }

        // Redirect back with success or error message
        if ($funds) {
            return back()->with('success', "We've received your fund request, and our team will proceed with the necessary steps to fund your account. Expect updates through your email registered with us.");
        }

        return back()->with('error', 'An error occurred, please try again.')->withInput();
    }

    
    public function update(RequestFund $requestFund, $action)
    {
        if ($requestFund->update(['status' => $action]))
            return back()->with('success', 'Request Updated successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }
}
