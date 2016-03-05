<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Run as Whoops;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if (config('app.debug') && $request->wantsJson()) {
            return self::renderJson($e);
        }

        return parent::render($request, $e);
    }

    /**
     * Render an exception into a JSON HTTP response.
     *
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public static function renderJson(Exception $e)
    {
        $headers    = $e->getHeaders();
        $statusCode = $e->getStatusCode();
        $whoops     = new Whoops;

        $whoops->pushHandler(new JsonResponseHandler);

        return new Response($whoops->handleException($e), $statusCode, $headers);
    }
}
