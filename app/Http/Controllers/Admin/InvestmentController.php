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

        $amount = 0;

        $inv = Investment::firstOrNew(['user_id' => $user_id, 'type' => $request['type']]);

        $amount = $inv->amount;

        $inv->amount = (float) $request['amount'] + $amount;

        $inv->save();

        $msg = 'You have invested $'. $request['amount'];

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

        if($investment->status == 'closed' && $request['status'] == 'closed') return back()->with('error', 'You can\'t update a closed investment');

        if (!$investment) return back()->with('error', 'Investment not found');
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'investment' => 'required|string',
            'status' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error', $validator->errors()->first());

        if ($investment->update(['ROI' => $request['amount'], 'amount' => $request['investment'], 'status' => $request['status']])) return back()->with('success', 'Investment successfully updated');

        return back()->with('error', 'An error occurred, try again.');

    }


}
