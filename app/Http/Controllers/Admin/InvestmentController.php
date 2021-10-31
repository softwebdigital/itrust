<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Models\Investment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvestmentController extends Controller
{

    public function index()
    {
        $investments = Investment::query()->orderByDesc('created_at')->get();
        return view('admin.investment', compact('investments'));
    }


    public function investUser(Request $request, $user_id)
    {
        // dd($request->all(), $user_id);

        $user = User::find($user_id);
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'type' => 'required',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first());

        if (Investment::create(['type' => $request['type'], 'amount' => (float) $request['amount'], 'user_id' => $user_id])){
            $msg = 'You have invested $'. $request['amount'];
        }

        $mail = [
            'name' => $user->name,
            'subject' => 'Investment successful',
            'body' => $msg
        ];

        MailController::sendInvestmentNotification($user, $mail);
        return redirect()->route('admin.users')->with($msg);

    }


    public function addRoi(Request $request, $investment_id)
    {
        $investment = Investment::find($investment_id);
        
        if (!$investment) return back()->with('error', 'Investment not found');
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
        ]);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        if ($investment->update(['ROI' => $request['amount']])) return back()->with('success', 'ROI successfully added');

        return back()->with('error', 'An error occurred, try again.');

    }


}
