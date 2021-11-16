<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;
use Illuminate\Support\Facades\Redirect;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ThrottleRequestsException $e, $request) {
            // Не самое лучшее решение, но на данный момент лучше не нашел
            // Если производится запрос по апи, то возвращаем текст со статусом
            // Если нет то возращаем текст ошибки
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => __('errors.throttle')
                ], 429);
            }
            else{
                return Redirect::back()->withErrors(["throttle"=>__('errors.throttle')]);
            }
        });
    }
}
