<?php
namespace App\Helpers;
use DB;
use App\Models\UpsiSharing;
use Illuminate\Support\Str;

class ResponseHelper{
    public function getData($table,$condition){
        $data = DB::table($table)->where($condition)->first();
        return $data;
    }
    function generateCode()
    {
        do {
            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $upsiOTP = "UPSI" . $otp;
        } while (UpsiSharing::where('upsi_id', $upsiOTP)->exists());
    
        return $upsiOTP;
    }
}