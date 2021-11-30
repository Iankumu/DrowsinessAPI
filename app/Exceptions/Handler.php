<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;

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
    }

    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     if($request->expectsJson()){
    //         return $request->expectsJson()
    //         ? response()->json(['message' => 'Authenticated.'], 200)
    //         : response()->json([
    //             'message' => 'Unauthenticated.',
    //             'status' => Response::HTTP_UNAUTHORIZED,
    //             'Description' => 'Missing or Invalid Access Token'
    //         ], 401);
    //     }else
    //     {
    //         return redirect('/')->with('error','Unauthenticated. Please Login to Continue');
    //     }
    // }
}
