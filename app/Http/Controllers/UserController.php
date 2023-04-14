<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->input('mobile'))->first();

        if (!$user) {
            $user = User::create([
                'mobile' => $request->input('mobile'),
            ]);
        }

        $now=now();
        //generateRandomNumber();
        $otp = rand(1000, 9999);
        $user->otp = $otp;
        //$user->otp_expire_at =  $now->addMinutes(10);
        $user->save();


        // if($userOtp && $now->isBefore($userOtp->expire_at)){
        //     return $userOtp;
        // }

        //$userOtp->sendSMS($request->mobile_no);

         // Send OTP via SMS
        // $twilio = new \Twilio\Rest\Client(config('services.twilio.sid'), config('services.twilio.token'));
        // $message = $twilio->messages->create(
        //     $request->input('phone_number'), // phone number to send SMS to
        //     [
        //         'body' => 'Your OTP is: '.$otp,
        //         'from' => config('services.twilio.from'),
        //     ]
        // );

        return response()->json(['message' => 'OTP sent successfully']);

        //return redirect()->route('loginForm');
    }

    public function loginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'otp' => 'required',
        ]);
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user || !($request->otp == $user->otp)) {
            return response()->json(['message' => 'The provided credentials are incorrect.']);
        }
        if($user && $now->isBefore($user->expire_at)){
            return $userOtp;
        }
      
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    //   /**
    //  * @param array $request
    //  * @return array
    //  */
    // public function sendEmailVerificationOTP(array $request) : array
    // {
    //     $response = [];
    //     DB::beginTransaction();

    //     try {
    //         $otp = generateRandomNumber();
    //         $user = $this->model::where('email',$request['email'])->first();

    //         if($user) {
    //             $user->otp = $otp;
    //             $user->save();
    //             //Send email to user
    //             dispatch(new EmailVerificationJob($user));

    //             $response['status'] = Constant::STATUS_ONE;
    //             $response['data'] = $user;

    //             DB::commit();
    //         } else {
    //             $response['status'] = Constant::STATUS_TWO;
    //         }

    //     } catch (\Exception $ex) {
    //         Log::error($ex);
    //         $response['status'] = Constant::STATUS_ZERO;
    //         DB::rollBack();
    //     }

    //     return $response;
    // }

    // /**
    //  * @param array $request
    //  * @return array
    //  */
    // public function otpVerificationProcess(array $request) : array
    // {
    //     $response = [];
    //     DB::beginTransaction();

    //     try {
    //         $user = $this->model::where('otp',$request['otp'])->where('email',$request['email'])->first();

    //         if($user) {
    //             $user->otp_verified_at = now();
    //             $user->save();
    //             $response['status'] = Constant::STATUS_ONE;
    //             $response['data'] = $user;
    //             DB::commit();
    //         } else {
    //             $response['status'] = Constant::STATUS_TWO;
    //         }
    //     } catch (\Exception $ex) {
    //         Log::error($ex);
    //         DB::rollBack();
    //     }

    //     return $response;
    // }


     /**
     * @param $id
     * @return array
     */
    // public function resendOTP($id) : array
    // {
    //     $response = [];
    //     DB::beginTransaction();

    //     try {
    //         $otp = generateRandomNumber();
    //         $user = $this->model::find($id);

    //         if($user) {
    //             $user->otp = $otp;
    //             $user->save();
    //             //Send email to user
    //             dispatch(new EmailVerificationJob($user));
    //             $response['status'] = Constant::STATUS_ONE;
    //             $response['data'] = $user;

    //             DB::commit();
    //         } else {
    //             $response['status'] = Constant::STATUS_TWO;
    //         }
    //     } catch (\Exception $ex) {
    //         Log::error($ex);
    //         DB::rollBack();
    //     }

    //     return $response;
    // }

}
