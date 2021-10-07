<?php

namespace App\Exceptions;

use App\Http\Middleware\Authenticate;
use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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

    public function render($request, Throwable $exception)
    {
        if($exception instanceof ValidationException){
           return $this->convertValidationExceptionToResponse($exception,$request);
        }

        if($exception instanceof ModelNotFoundException){
            $modelName=strtolower(class_basename($exception->getModel()));

          return  $this->errorResponse("Does not exists any {$modelName} with the specified identificator",404);
        }

        // if($exception instanceof AuthenticationException){
        //     return $this->unauthenticated($request,$exception);
        // }
        // if($exception instanceof AuthorizationException){
        //     return $this->errorResponse($exception->getMessage(),403);
        // }
        if($exception instanceof NotFoundHttpException){
            return $this->errorResponse('The specified url cannot found',404);
        }
        if($exception instanceof MethodNotAllowedHttpException){
            return $this->errorResponse('The specified method for the requestes is invalid',405);
        }
        if($exception instanceof HttpException){
            return $this->errorResponse($exception->getMessage(),$exception->getStatusCode());
        }
        if($exception instanceof QueryException){
            $errorCode=$exception->errorInfo[1];
            if($errorCode == 1451){
                return $this->errorResponse('Cannot remove this resource parmanently, it is related with any other resources',409);
            }
           
        }

       // return $this->errorResponse('Unexpected Exception. Try Later',500);


        return parent::render($request,$exception);
    }
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors= $e->validator->errors()->getMessages();
        return $this->errorResponse($errors,422);
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('Unauthenticated.',401);

    }
}
