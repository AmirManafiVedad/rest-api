<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()){
            /** @var Validation\ValidationException $exception */
            $exception = $this->prepareException($exception);

//            Control Error Validation
            if ($exception instanceof Validation\ValidationException){
                return response([ 'error' => $exception->errors()] , 422);
            }
//            End Control Error Validation

            $code = method_exists($exception , 'getStatusCode')? $exception->getStatusCode() : 500;
            $code = (empty($code) ? 500 : $code);
            return response([
                'message' => $code === 500 ? 'خطایی در سرور رخ داده است' : $exception->getMessage()
            ], $code);

        }
        return parent::render($request, $exception);
    }
}
