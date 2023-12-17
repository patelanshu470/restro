<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\VerificationCode;
use Auth;
use DB;

class AuthOtpController extends Controller
{
    public function login()
    {
        return view('auth.otp-login');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|exists:users,phone_number'
        ]);
        $verificationCode = $this->generateOtp($request->phone_number);
        $message = "Your OTP To Login is - ".$verificationCode->otp;

        return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message);
    }

    public function resend(Request $request,$no)
    {
        if($request->phone_number){
            $m_no=$request->phone_no;
        }else{
            $m_no=$no;
        }
        $id_get = User::where('phone_number',$m_no)->first();
        $all_data = VerificationCode::where('user_id',$id_get->id)->first();
        $now = Carbon::now();
        if($now->isAfter($all_data->expire_at)){
            VerificationCode::where('user_id',$id_get->id)->delete();
        }
        $verificationCode = $this->generateOtp($m_no);
        $message = "Your OTP To Login is - ".$verificationCode->otp;

        return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message);
    }

    public function generateOtp($phone_number)
    {
        $user = User::where('phone_number', $phone_number)->first();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        $now = Carbon::now();
        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }

        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(1)
        ]);
    }

    public function verification($user_id)
    {
        return view('auth.otp-verification')->with([
            'user_id' => $user_id
        ]);
    }

    public function loginWithOtp(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'otp' => 'required'
        // ])->with('error', 'Please Enter OTP');
        if($request->otp == NULL)
        {
            return redirect()->back()->with('error', 'Please Enter OTP');
        }
        $verificationCode   = VerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            VerificationCode::where('user_id',$verificationCode->user_id)->delete();
            return redirect()->route('otp.verification',$request->user_id)->with('error', 'Your OTP has been expired');
        }
        $user = User::whereId($request->user_id)->first();
        if($user){
            // Expire The OTP
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);
            Auth::login($user);
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            $email_token = $accessToken->token;
            User::where('id',$user->id)->update(['remember_token' => $email_token,'verified_phone_number' => 1]);
            return redirect('/');
        }

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }

}
