<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mail;
use App\Models\Restaurant;
use App\Models\User;
use Hash;
use Auth;
use App\Models\VerificationCode;
use DB;
use Carbon\Carbon;


class SettingController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.restaurant.setting.index');
    }

    public function mail(Request $request)
    {
        $find_restro = Restaurant::where('user_id',auth()->user()->id)->first();
        $user = User::find(auth()->user()->id);
        $request->validate([
            'old_password' => 'required',
        ]);
        // Old Password match...
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Password Doesn't match!");
        }

        $newEmail = $request->email;
        session()->put('newEmail', $newEmail);
        // $mailss = $this->generate($newEmail);
        return redirect()->route('otp.generateemail');
    }

    public function generate()
    {
        $email = auth()->user()->email;
        $verificationCode = $this->generateOtp($email);
        $message = "Your OTP To Login is - ".$verificationCode->otp;
        $mail_data = [
            'recipient' => auth()->user()->email,
            'fromEmail' => 'rakesh.coders@gmail.com',
            'fromName' => "Rakesh Jadhav",
            'companyName' => 'The Diners Club',
            'subject' => " verification",
            'otp' => $verificationCode->otp,
            // 'body' => $verificationCode->otp,
        ];
        \Mail::send('pages.restaurant.setting.otp-mail',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
            ->from($mail_data['fromEmail'],$mail_data['companyName'])
            ->subject($mail_data['subject']);
        });

        return redirect()->route('otp.verificationemail', ['user_id' => $verificationCode->user_id])->with('success',  $message);
    }

    public function resend(Request $request,$no)
    {
        if($request->email){
            $email=$request->email;
        }else{
            $email=$no;
        }
        $id_get = User::where('email',$email)->first();
        $all_data = VerificationCode::where('user_id',auth()->user()->id)->first();
        $now = Carbon::now();
        if($now->isAfter($all_data->expire_at)){
            VerificationCode::where('user_id',auth()->user()->id)->delete();
        }
        $verificationCode = $this->generateOtp($email);
        $message = "Your OTP To Login is - ".$verificationCode->otp;

        $mail_data = [
            'recipient' => auth()->user()->email,
            'fromEmail' => 'rakesh.coders@gmail.com',
            'fromName' => "Rakesh Jadhav",
            'companyName' => 'The Diners Club',
            'subject' => " verification",
            'otp' => $verificationCode->otp,
            // 'body' => $verificationCode->otp,
        ];
        \Mail::send('pages.restaurant.setting.otp-mail',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
            ->from($mail_data['fromEmail'],$mail_data['companyName'])
            ->subject($mail_data['subject']);
        });
        return redirect()->route('otp.verificationemail', ['user_id' => $verificationCode->user_id])->with('success',  $message);
    }

    public function generateOtp()
    {
        // $email = Auth::user->email;
        $user = User::where('email', auth()->user()->email)->first();
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
        return view('pages.restaurant.setting.otp-verification')->with([
            'user_id' => $user_id
        ]);
    }

    public function MailWithOtp(Request $request)
    {
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
            return redirect()->route('otp.verificationemail',$request->user_id)->with('error', 'Your OTP has been expired');
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
            $getEmail = session()->get('newEmail');
            User::where('id',$user->id)->update(['email' => $getEmail]);
            return redirect()->route('restro.setting')->with('success', 'Your Email Change Successfully');
        }

        return redirect()->route('otp.verificationemail')->with('error', 'Your Otp is not correct');
    }
}
