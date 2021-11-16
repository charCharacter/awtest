<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Mail\FormSent;
use App\Models\Form;
use App\Models\User;
use App\Services\Captcha;
use App\Services\Random;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use function GuzzleHttp\Promise\all;

class FormController extends Controller
{
    public function __construct(){
    }
    public function  create(){
        $random = new Random();
        $captcha = Captcha::generateCode($random);
        return view("form.create", compact('captcha'));
    }

    public function store(StoreFormRequest $request){
        $validated = $request->validated();
        $captchaResult = request()->session()->get('result');
        $captchaExpiresTime = request()->session()->get('expires_time');
        $now = Carbon::now()->timestamp;
        if($captchaResult != $validated['secure']){
            return Redirect::back()->withErrors(["captcha"=>__('errors.captcha')]);
        }
        if($captchaExpiresTime<$now){
            return Redirect::back()->withErrors(["captcha"=>__('errors.captcha_expires')]);
        }
        $user = User::firstOrCreate($validated['user']);
        unset($validated['user']);
        $validated['user_id'] = $user->id;
        $form = Form::create($validated);

        Mail::to($user->email)->send(new FormSent($form));
        Mail::to('personaj.5000@gmail.com')->send(new FormSent($form,true));

        return redirect()->route('form.create')->with('success','Форма отправлена');
    }

    public function userForm($id){
        $forms = Form::where('user_id',$id)->get();
        return view("form.index", compact('forms'));
    }

}
