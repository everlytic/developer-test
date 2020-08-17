<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($this->isModelNotFound($e)) {
            return $this->CustomModelResponseException($e);
        }

        if ($this->isNotFoundHttp($e)) {
            return $this->CustomHttpResponseException($e);
        }

        if ($this->isThrottleRequests($e)) {
            return $this->CustomRequestResponseException($e);
        }

        if ($this->isMethodNotAllowed($e)) {
            return $this->CustomMethodResponseException($e);
        }

        return parent::render($request, $e);
    }

    protected function isModelNotFound($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isNotFoundHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function isThrottleRequests($e)
    {
        return $e instanceof ThrottleRequestsException;
    }

    protected function isMethodNotAllowed($e)
    {
        return $e instanceof MethodNotAllowedHttpException;
    }

    protected function CustomModelResponseException($e)
    {
        return response()->json([
            'errors' => 'Record not found, please check if the record does exist.'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function CustomHttpResponseException($e)
    {
        return response()->json([
            'errors' => 'Requested path is incorrect, please check if you are using the correct path.'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function CustomRequestResponseException($e)
    {
        return response()->json([
            'errors' => 'You are currently making too many requests right now and the server cannot handle the amount of requests you are sending. Please slow down your request rate by waiting for some time and try again after some few seconds.'
        ], Response::HTTP_TOO_MANY_REQUESTS);
    }

    protected function CustomMethodResponseException($e)
    {
        return response()->json([
            'errors' => 'The method received in the request-line is known by the origin server but not supported by the target resource. Please check if you have included the target resource in the request-line.'
        ], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
