<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Neomerx\JsonApi\Exceptions\JsonApiException;
use CloudCreativity\LaravelJsonApi\Exceptions\HandlesErrors;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use HandlesErrors;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        JsonApiException::class,
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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($this->isJsonApi($request, $exception)) {
            // Format correctly the Laravel Validation Exceptions
            if ($exception instanceof ValidationException) {
                $renderedException = $this->renderJsonApi($request, $exception);

                return $this->formatNativeValidationErrors($renderedException);
            }
            return $this->renderJsonApi($request, $exception);
        }

        return parent::render($request, $exception);
    }

    protected function prepareException(Exception $e)
    {
        if ($e instanceof JsonApiException) {
            return $this->prepareJsonApiException($e);
        }

        return parent::prepareException($e);
    }

    /**
     * Re-format Laravel's native validation errors to mimic json:api spec
     *
     * @param $renderedException
     * @return mixed
     */
    protected function formatNativeValidationErrors($renderedException)
    {
        $exceptionContent = json_decode($renderedException->getContent(), true);

        $exceptionContent['errors'] = array_map(function ($error) {
            $error['source']['pointer'] = "/data/attributes/{$error['meta']['key']}";
            unset($error['meta']);
            return $error;
        }, $exceptionContent['errors']);

        $renderedException->setContent(json_encode($exceptionContent));

        return $renderedException;
    }
}
