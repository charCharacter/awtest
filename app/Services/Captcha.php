<?php

namespace App\Services;
use Carbon\Carbon;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class Captcha{
    static function generateCode( Random $random): string
    {
        $builder = new CaptchaBuilder($random->getString());
        $builder->build($width = 150, $height = 40, $font = $_SERVER['PWD'].'/vendor/gregwar/captcha/src/Gregwar/Captcha/Font/captcha1.ttf');
        request()->session()->put('result',$random->getResult());
        request()->session()->put('expires_time',Carbon::now()->timestamp+60);
        return $builder->inline();
    }
}
