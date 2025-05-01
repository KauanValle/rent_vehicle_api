<?php

namespace App\Exceptions;

use Elastic\Elasticsearch\Exception\ClientResponseException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error in the submitted data',
                'errors' => $exception->errors()
            ], 422);
        }

        if ($exception instanceof QueryException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error processing the request in the database',
                'details' => env('APP_DEBUG') ? $exception->getMessage() : 'Internal Error'
            ], 500);
        }

        if ($exception instanceof JWTException) {
            return response()->json(['error' => 'Error in Token JWT.'], 401);
        }

        if($exception instanceof UnauthorizedHttpException){
            return response()->json([
                'status' => 'error',
                'error' => 'Invalid token, please log in again.'
            ], 401);
        }

        if($exception instanceof ClientResponseException ){
            return response()->json([
                'status' => 'error',
                'error' => 'Invalid index, contact adminstrator.'
            ], 401);
        }

        $code = $exception->getCode() ? $exception->getCode() : 500;
        return response()->json([
            'status' => 'error',
            'message' => $exception->getMessage(),
        ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : $code);
    }


    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

}
