<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Constant\Constant;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Twilio\Rest\Client;

// if (!function_exists('includeRouteFiles')) {
//     /**
//      * Loops through a folder and requires all PHP files
//      * Searches sub-directories as well.
//      *
//      * @param $folder
//      */
//     //public static function includeRouteFiles($folder)
//     function includeRouteFiles($folder)
//     {
//         $directory = $folder;
//         $handle = opendir($directory);
//         $directory_list = [$directory];

//         while (false !== ($filename = readdir($handle))) {
//             if ($filename != '.' && $filename != '..' && is_dir($directory . $filename)) {
//                 array_push($directory_list, $directory . $filename . '/');
//             }
//         }

//         foreach ($directory_list as $directory) {
//             foreach (glob($directory . '*.php') as $filename) {
//                 require $filename;
//             }
//         }
//     }
// }



if (!function_exists('generateRandomNumber')) {
    /**
     * @param int $length
     * @return int
     */
    function generateRandomNumber($length = 4): int
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


if (!function_exists('sendSMS')) {
    /**
     * @param int $length
     * @return int
     */
    function sendSMS($mobile,$otp): int
    {
        $message = "Login OTP is ".$otp;
    
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($mobile, [
                'from' => $twilio_number, 
                'body' => $message]);
   
            info('SMS Sent Successfully.');
    
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}

// if (!function_exists('getCountries')) {
//     /**
//      * get all country table content
//      * @return mixed
//      */
//     function getCountries()
//     {
//         try {
//             $countryTable = config('model-variables.models.country.table');
//              return DB::table($countryTable)->get();
//         } catch (Exception $ex) {
//             Log::error($ex->getMessage());
//         }
//     }
// }