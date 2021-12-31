<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hizbul\SmsVerification\SmsVerification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{

    public function generateAndSendPin(Request $request){

        $this->validate($request, [
            "phone" => "required"
        ]);

//        if ($this->userContactVerified()){
//            return back()->with(["message" => "Phone number has already been verified"],403);
//        }

        $phone = $request['phone'];

        $response = Http::post('https://termii.com/api/sms/otp/send', [
            "api_key" => env('TERMII_API_KEY'),
            "message_type" => env('TERMII_MSG_TYPE'),
            "to" => $phone,
            "from" => env('TERMII_FROM'),
            "channel" => env('TERMII_CHANNEL'),
            "pin_attempts" => env('TERMII_PIN_ATTEMPT'),
            "pin_time_to_live" => env('TERMII_PIN_TIME_TO_LIFE'),
            "pin_length" => env('TERMII_PIN_LENGTH'),
            "pin_placeholder" => "< 1234 >",
            "message_text" => "Your verification pin for CoinNG is < 1234 >",
            "pin_type" => "NUMERIC",
        ])->json();

//        if (array_key_exists("smsStatus", $response)){
//
//            if ($response['smsStatus'] === "Message Sent"){
//                return response()->json(["status" => "Message sent to $phone", "pinId" => $response['pinId']]);
//            }
//
//        }

//        $response = Http::get("https://api.nexmo.com/verify/json",[
//            'api_key' => env('VONAGE_API_KEY'),
//            'api_secret' => env('VONAGE_API_SECRET'),
//            'number' => $request['phone'],
//            'brand' => 'AcmeInc'
//        ]);
        return $response;
    }

    public function verifyPin(Request $request){
        $this->validate($request, [
            "pin" => "required|min:6|max:6",
            "pin_id" => "required",
        ]);

//        if ($this->userContactVerified()){
//            return response()->json(["message" => "Phone number has already been verified"],403);
//        }

        $pin = $request['pin'];
        $pin_id = $request['pin_id'];

        $response = Http::post('https://termii.com/api/sms/otp/verify', [
            "api_key" => env('TERMII_API_KEY'),
            "pin_id" => $pin_id,
            "pin" => $pin,
        ])->json();

//        if (array_key_exists("verified", $response)){
//            if ($response['verified'] === true){
//                $user = Auth::user();
//                $user->contact_verification = 1;
//                $user->save();
//                return response()->json(["success" => "Phone number verified"],200);
//            }elseif ($response['verified'] === "Expired"){
//                return response()->json(["message" => "Pin Expired"],422);
//            }
//        }
//
//        if (array_key_exists("attemptsRemaining", $response)){
//            return response()->json(["message" => "Pin Incorrect", "attemptsRemaining" => $response['attemptsRemaining'] ],422);
//        }
//        $response = Http::get('https://api.nexmo.com/verify/check/json', [
//            'api_key' => env('VONAGE_API_KEY'),
//            'api_secret' => env('VONAGE_API_SECRET'),
//            'request_id' => $pin_id,
//            'code' => $pin
//        ]);
        return $response;
    }

    public function userContactVerified(): bool
    {
        if (Auth::user()['contact_verification'] === 1){
            return true;
        }
        return false;
    }

    public function changeEmail()
    {
        return view('auth.email_change');
    }



    public function postChangeEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email'
        ]);
        if ($validator->fails()) return back()->with(['validation' => true, 'error' => 'The email has already been taken.'])->withInput()->withErrors($validator);

        $user = User::find(Auth::id());
        if ($user->update(['email' => $request->input('email')])){
            $user->sendEmailVerificationNotification();
        }
        return redirect()->route('user.portfolio')->with('success', 'Email Changed Successfully');
    }


}
